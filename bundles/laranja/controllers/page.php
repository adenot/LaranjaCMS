<?php

class Laranja_Page_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public function action_index($path)
	{
		/* TODO:
		   Load all pages recursively and feed the page with a json array
		   AngularJS then will get this json and iterate, get all children and request it's data as templates
		   Templates should be cached in the client to avoid requesting it again
		   
		   Need both dynamic and static contents:
		      Dynamic: loaded in the client by angular
			     change based on hash-path /#something
			  Static: loaded by laravel in the server
			     change based on base-path /something
		*/

        $page = new Page($path);

		if ( ! $page->exists())
		{
			return Response::error('404');
		}
	
		$content = $page->fetch_children();
		
		echo json_encode($content);return;
		
		
		
	
		return View::make('laranja::page')->with('path', $path)->with('content', $json_content);
	}

}