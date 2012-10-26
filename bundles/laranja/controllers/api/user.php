<?php

class Laranja_Api_User_Controller extends Laranja_Api_Base_Controller {

	const MSG_UPDATE_SUCCESS = 'User saved';
	const MSG_UPDATE_ERROR = 'Error while saving';
	
	public function post_update() 
	{
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
		
		if ($validation->fails()) 
		{
			return $this->_resultFail($validation->errors);
		}
		
		$meta_data = array(
			'username' => $input->username,
		);
		
		$user = LaranjaUser::get_storage($input->username);
		
		if ( ! $user) 
		{
			/* new user */

			$user = new LaranjaUser();
			
			$user->id = $user->generate_storage_id($input->username);

		}
		
		$user->set_data(array(
			'password' => Hash::make($input->password),
			'email' => $input->email,
		));
		
		$user->set_meta_data($meta_data);

		$ret = $user->save();
		
		if ($ret) 
		{ 
			return $this->_resultSuccess(self::MSG_UPDATE_SUCCESS);
		}
		else 
		{
			return $this->_resultFail(self::MSG_UPDATE_ERROR);
		}
		
	}

	/** 
	 * POST auth
	 * JSON input: 
	 *   String username
	 *   String password
	 *   Boolean remember
	 */
	public function post_auth() 
	{
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
		
		if ($validation->fails()) 
		{
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
