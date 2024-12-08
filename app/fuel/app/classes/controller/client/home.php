<?php

class Controller_Client_Home extends Controller_Template
{
	public function before()
    {
        parent::before();
        // Chỉ định layout cho admin
        $this->template = View::forge('layouts/user');
    }
	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Client/home &raquo; Index';
		$this->template->content = View::forge('client/home/index', $data);
	}

}
