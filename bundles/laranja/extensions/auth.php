<?php

class Laranja_Auth extends Laravel\Auth\Drivers\Driver {

	/**
	 * Get the current user of the application.
	 *
	 * If the user is a guest, null should be returned.
	 *
	 * @param  int         $id
	 * @return mixed|null
	 */
	public function retrieve($username)
	{
		return $this->model()->get_storage($username);
	}

	/**
	 * Attempt to log a user into the application.
	 *
	 * @param  array  $arguments
	 * @return void
	 */
	public function attempt($arguments = array())
	{
		$username = Config::get('auth.username');

		$user = LaranjaUser::get_storage($arguments['username']);
		
		// User does not exist
		if ( ! $user) { 
			return false; 
		}
		
		$data = $user->get_data();
		
		// Storage missing
		if ( ! $data) 
		{ 
			return false; 
		}

		// This driver uses a basic username and password authentication scheme
		// so if the credentials match what is in the database we will just
		// log the user into the application and remember them if asked.
		$password = $arguments['password'];

		if (Hash::check($password, $data['password']))
		{
			return $this->login($arguments['username'], array_get($arguments, 'remember'));
		}

		return false;
	}

	/**
	 * Get a fresh model instance.
	 *
	 * @return Eloquent
	 */
	protected function model()
	{
		$model = Config::get('auth.model');

		return new $model;
	}

}