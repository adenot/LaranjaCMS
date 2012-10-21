<?php

class Laranja_Api_User_Controller extends Laranja_Api_Base_Controller {

	public function get_auth() {
		return "get_auth";
	}
	
	public function post_update() {
		/* Test input:
		{"username": "adenot", "password": "password", "password_confirmation": "password", "email": "adenot@gmail.com", "role": 1}
		*/
	
		$input = Input::json();
	
		$rules = array(
			'username' => 'required',
			'password' => 'required|min:8|confirmed',
			'email' => 'required',
			'role' => 'required',
		);

		/* TODO: Role can be refused if the logged is trying to create 
		   another user with higher role them him/her */
		   
		$validation = Validator::make(get_object_vars($input), $rules);
		
		if ($validation->fails()) {
			return $this->_resultFail($validation->errors);
		}
		
		$storage_id = Hash::make($input->username);
		
		$user = new Laranja_User();
		$user->username = $input->username;
		$user->storage_id = $storage_id;
		
		$storage = new Laranja_Storage();
		$storage->id = $storage_id;
		$storage->set_data(array(
			'password' => Hash::make($input->password),
			'email' => $input->email,
		));
		
		$storage->user()->insert($user);
		$storage->save();
		
		
	}

	/** 
	 * POST auth
	 * JSON input: 
	 *   String username
	 *   String password
	 *   Boolean remember
	 */
	public function post_auth() {
		/* Test input:
		{"username": "adenot", "password": "password", "remember": 1}
		*/
		
		$input = Input::json();
		
		$rules = array(
			'username' => 'required',
			'password' => 'required',
			'remember' => 'required',
		);
		
		$validation = Validator::make(get_object_vars($input), $rules);
		
		if ($validation->fails()) {
			return $this->_resultFail($validation->errors);
		}
		
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
