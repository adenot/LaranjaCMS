<?php

class Laranja_Api_User_Controller extends Laranja_Api_Base_Controller {

	public function get_auth() {
		return "get_auth";
	}

	public function post_auth() {
		$input = Input::json();
		
		$credentials = array(
			'username' => $input->username,
			'password' => $input->password,
			'remember' => (bool) $input->remember
		);
		
		if (Auth::attempt($credentials))
		{
			return json_encode(array('status' => 1));
		} 
		else
		{
			return json_encode(array('status' => 0));
		}
	}

}
