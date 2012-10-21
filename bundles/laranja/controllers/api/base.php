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
	
	public function get() {
		return "Get_Api_Base";
	}
	
	public function action_index() {
		return "Api_Base";
	}
}