<?php

class Laranja_Api_User_Controller extends Base_Controller {

    public $restful = true;

	
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
