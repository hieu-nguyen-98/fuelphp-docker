<?php

use Fuel\Core\DB;
use Fuel\Core\Input;
use Fuel\Core\Response;
use Fuel\Core\Session;
use Fuel\Core\View;

class Controller_Admin_Dashboard extends Controller_Template
{
	public function before()
    {
        parent::before();

        // Kiểm tra xem người dùng đã đăng nhập chưa và là admin
        // if (!Session::get('user_id') && Session::get('user_group') != 1) {
        //     // Nếu không phải admin, chuyển hướng tới trang đăng nhập
        //     return Response::redirect('login');
        // }

        // Chỉ định layout cho admin
        $this->template = View::forge('layouts/admin');
    }
	public function action_index()
	{
        $today = date('Y-m-d'); 
        $five_days_ago = date('Y-m-d', strtotime('-5 days'));
        $first_day_of_month = date('Y-m-01');
        $start_date = Input::get('start_date', $today);
        $end_date = Input::get('end_date', $today); 
        if ($start_date == $end_date) {
            $dates = [$today]; 
        } else {
            $dates = [];
            $current_date = strtotime($start_date);
            $end_date_str = strtotime($end_date);
        
            while ($current_date <= $end_date_str) {
                $dates[] = date('Y-m-d', $current_date); // Thêm từng ngày vào mảng
                $current_date = strtotime("+1 day", $current_date); // Tiến tới ngày kế tiếp
            }
        }
        // dd($end_date);
        $teamId = Input::get('team_id');

        $search = [
            'team_id'   => $teamId,
            'start_date'=> Input::get('start_date', $today),
            'end_date'  => Input::get('end_date', $today),
        ];

        $reports = Model_Report::query();
        $reports->related('team');
        // $reports = $this->get_with_relationshop('Model_Report', $relation, $search);
        $reports = Model_Report::query();
            $reports->related('team');
            if($search['team_id']){
                $reports->where('team_id', $search['team_id']);
            }
            if($search['start_date']){
                $reports->where('created_at', '>=', $search['start_date']);
            }
            if($search['end_date']){
                $reports->where('created_at', '<=', DB::expr("DATE_ADD('{$search['end_date']}', INTERVAL 1 DAY)"));
            }
        $reports = $reports->get();
        // Tạo mảng dữ liệu cho từng ngày và user
        $report_data_by_user = [];
        foreach ($reports as $report) {
            $key = $report->team_id . '-' . $report->user_id;
            $team = Model_Team::find($report->team_id);
            $team_name = $team ? $team->name : 'Unknown Team';
            foreach ($dates as $date) {
                if (substr($report->created_at, 0, 10) == $date) {
                    if (!isset($report_data_by_user[$key])) {
                        $report_data_by_user[$key] = [
                            'team_id'  => $report->team_id,
                            'user_id'  => $report->user_id,
                            'team_name'=> $team_name, 
                            'tasks'    => [],
                            'notes'    => [],
                            'dates'    => []
                        ];
                    }

                    $report_data_by_user[$key]['tasks'][$date][] = $report->yesterday_tasks;
                    $report_data_by_user[$key]['notes'][$date][] = $report->note;
                    $report_data_by_user[$key]['dates'][] = $report->created_at;
                }
            }
        }
        foreach ($report_data_by_user as $key => $user_data) {
            foreach ($user_data['tasks'] as $date => $tasks) {
                $report_data_by_user[$key]['tasks'][$date] = implode(', ', $tasks);
            }
           
        }
        // Dữ liệu cho view
        $data = [
            'reports'                => $reports, // Toàn bộ báo cáo
            'teamId'                 => $search['team_id'] ?? '', // team_id đã chọn
            'dates'                  => $dates, // Mảng các ngày bạn đang tìm kiếm
            'report_data_by_user'    => $report_data_by_user, // Báo cáo đã được gộp theo ngày và user
            'start_date'             => $start_date, // Ngày bắt đầu tìm kiếm
            'end_date'               => $end_date, // Ngày kết thúc tìm kiếm
            'teams'                  => Model_Team::find('all'), // Danh sách teams
            'today'                  => $today, // Ngày hôm nay
            'five_days_ago'          => $five_days_ago,
            'first_day_of_month'     => $first_day_of_month,
        ];

		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Admin/dashboard &raquo; Index';
		$this->template->content = View::forge('admin/dashboard/index', $data);
	}

}
