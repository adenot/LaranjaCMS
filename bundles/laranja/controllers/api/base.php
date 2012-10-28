<?php

class Laranja_Api_Base_Controller extends Controller {
	public $restful = true;

	const MSG_AUTH_FAIL = 'Not authenticated';
	
	const CODE_SUCCESS = 1;
	const CODE_FAIL = 0;
	const CODE_FAIL_AUTH = -1;
	
	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}
	
	protected function _resultFail($errors, $status = self::CODE_FAIL) {
		if (is_string($errors)) {
			$errors_messages = array($errors);
		} else {
			$errors_messages = $errors->messages;
		}
		
		$result = array('status' => $status, 'errors' => $errors_messages);
		
		return json_encode($result);
	}
	
	protected function _resultSuccess($message, $status = self::CODE_SUCCESS) {
		$result = array('status' => $status, 'message' => $message);
		
		return json_encode($result);
	}
	
	protected function auth() {
		if ( ! Auth::check())
		{
			echo self::_resultFail(self::MSG_AUTH_FAIL, self::CODE_FAIL_AUTH);
			return false;
		}
		
		return true;
	}
	
	public function get() {
		return "Get_Api_Base";
	}
	
	public function action_index() {
		return "Api_Base";
	}
}