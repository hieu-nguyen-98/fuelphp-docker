<?php

use Auth\Auth;
use Fuel\Core\Debug;
use Fuel\Core\Input;
use Fuel\Core\Log;
use Fuel\Core\Response;
use Fuel\Core\Session;
use Fuel\Core\View;

class Controller_Auth extends Controller_Template
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Auth &raquo; Index';
		$this->template->content = View::forge('auth/index', $data);
	}

	// public function action_login()
	// {
	// 	if (Input::method() === 'POST') {
    //         $username = Input::post('username');
    //         $password = Input::post('password');
	// 		if(Auth::login($username, $password)) {
	// 			return 1;
	// 		}else{
	// 			$db_password = DB::select('password')->from('users')
	// 					->where('username', $username)->execute()->get('password');
	// 				Log::error('Database password: ' . $db_password);
		
	// 				Session::set_flash('error', 'Invalid username or password.');
	// 		}
	// 		// try {
	// 		// 	// Thêm debug trước khi thực hiện Auth::login
	// 		// 	Log::info('Attempting login with username: ' . $username);
				
	// 		// 	// Kiểm tra đăng nhập
	// 		// 	if (Auth::login($username, $password)) {
	// 		// 		return 123;
	// 		// 		return Response::redirect('/');
	// 		// 	} else {
	// 		// 		return 333333333;
	// 		// 		// Kiểm tra mật khẩu trong cơ sở dữ liệu
	// 		// 		$db_password = DB::select('password')->from('users')
	// 		// 			->where('email', $username)->execute()->get('password');
	// 		// 		Log::error('Database password: ' . $db_password);
		
	// 		// 		Session::set_flash('error', 'Invalid username or password.');
	// 		// 	}
	// 		// 	return 1;
	// 		// } catch (Exception $e) {
	// 		// 	// Xử lý ngoại lệ và log thông tin lỗi
	// 		// 	Session::set_flash('Error during login: ' . $e->getMessage());
	// 		// 	// Session::set_flash('error', 'An unexpected error occurred. Please try again.');
	// 		// }
    //     }

    //     return View::forge('auth/login');
	// }

	public function action_login()
	{
		if (Input::method() === 'POST') {

			$username = Input::post('username');
			$password = Input::post('password');
			
			$user = DB::select()->from('users')
								->where('username', '=', $username)
								->limit(1)
								->execute()
								->current();
			
			if ($user) {
				if (password_verify($password, $user['password'])) {
					Session::start();
					Session::set('user_id', $user['id']);
					Session::set('user_name', $user['username']);
					Session::set('user_email', $user['email']);
					Session::set('user_group', $user['group']);
					if($user['group'] == 1) {
						return Response::redirect('/admin/dashboard');
					}
					return Response::redirect('/');
				} else {
					Session::set_flash('error', 'Invalid username or password.');
				}
			} else {
				Session::set_flash('error', 'Invalid username or password.');
			}
		}

		return View::forge('auth/login');
	}

}
