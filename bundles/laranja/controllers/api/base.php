<?php

class Laranja_Api_Base_Controller extends Controller {
	public $restful = true;

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
	
	protected function _resultFail($errors, $status = 0) {
		if (is_string($errors)) {
			$errors_messages = array($errors);
		} else {
			$errors_messages = $errors->messages;
		}
		
		$result = array('status' => $status, 'errors' => $errors_messages);
		
		return json_encode($result);
	}
	
	protected function _resultSuccess($message, $status = 1) {
		$result = array('status' => $status, 'message' => $message);
		
		return json_encode($result);
	}
	
	public function get() {
		return "Get_Api_Base";
	}
	
	public function action_index() {
		return "Api_Base";
	}
}