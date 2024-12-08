<?php

use Fuel\Core\Response;
use Fuel\Core\Session;
use Fuel\Core\View;

class Controller_Admin_Dashboard extends Controller_Template
{
	public function before()
    {
        parent::before();

        // Kiểm tra xem người dùng đã đăng nhập chưa và là admin
        if (!Session::get('user_id') && Session::get('user_group') != 1) {
            // Nếu không phải admin, chuyển hướng tới trang đăng nhập
            return Response::redirect('login');
        }

        // Chỉ định layout cho admin
        $this->template = View::forge('layouts/admin');
    }
	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Admin/dashboard &raquo; Index';
		$this->template->content = View::forge('admin/dashboard/index', $data);
	}

}
