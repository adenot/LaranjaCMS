<?php

class Laranja_Api_Content_Controller extends Laranja_Api_Base_Controller {
	
	const MSG_UPDATE_SUCCESS = 'Content saved';
	const MSG_UPDATE_ERROR = 'Error while saving';
	
	public function get_open($path) 
	{
		/* TODO: Check authentication and content permission */
		
		if ( empty($path) ) return;

		$content = LaranjaContent::get_storage($path);
		
		return var_export($content,true);
		
	}
	
	public function post_update() 
	{
		/* Test input:
		{"path": "hero", "data": { "content": "hero banner" } }
		*/
		
		if ( ! $this->auth() )
		{
			return;
		}
	
		$input = Input::json();
	
		$rules = array(
			'path' => 'required',
			'data' => 'required',
		);

		/* TODO: Authenticate user and check role */
		   
		$validation = Validator::make(get_object_vars($input), $rules);
		
		if ($validation->fails()) 
		{
			return $this->_resultFail($validation->errors);
		}

		$meta_data = array(
			'path' => $input->path,
		);
		
		$content = LaranjaContent::get_storage($input->path);
		
		if ( ! $content) 
		{
			/* new content */

			$content = new LaranjaContent();
			
			$content->id = $content->generate_storage_id($input->path);

		}
		
		$content->set_data(get_object_vars($input->data));
		$content->set_meta_data($meta_data);

		$ret = $content->save();
		
		if ($ret) 
		{ 
			return $this->_resultSuccess(self::MSG_UPDATE_SUCCESS);
		}
		else 
		{
			return $this->_resultFail(self::MSG_UPDATE_ERROR);
		}
	}
}