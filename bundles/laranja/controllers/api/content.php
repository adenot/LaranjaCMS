<?php

class Laranja_Api_Content_Controller extends Laranja_Api_Base_Controller {
	
	const MSG_UPDATE_SUCCESS = 'Content saved';
	const MSG_UPDATE_ERROR = 'Error while saving';
	
	public function get_open($path) 
	{
		/* TODO: Do we want to restrict content based on authenticated user or only published/date? */
		
		if ( empty($path) ) return;

		$content = LaranjaContent::get_storage($path);
		
		$returnable = new stdClass();
		$returnable->id = $content->id;
		$returnable->data = $content->data;
		
		return json_encode($returnable);
		
	}
	
	public function post_update() 
	{
		/* Test input:
		[{"path": "_hero", "data": { "content": "<div id='hero'>hero banner</div>" } },
		{"path": "_header", "data": { "content": "<header>header</header>" } },
		{"path": "_footer", "data": { "content": "<footer>footer</footer>" } },
		{"path": "_sidebar", "data": { "content": "<aside>sidebar</aside>" } },
		{
			"path": "/",
			"data": {
				"children": [{
					"path": "_header",
					"grid": [ 0 ],
					"order": 0
				},{
					"path": "_footer",
					"grid": [ 0 ],
					"order": 99
				},{
					"path": "_body",
					"grid": [ 0 ],
					"order": 1
				}]
			}
		},
		{
			"path": "_body",
			"data": {
				"children": [{
					"path": "_hero",
					"grid": [ 0, 9 ],
					"order": 0
				},{
					"path": "_sidebar",
					"grid": [ 10, 12 ],
					"order": 1
				}]
			}
		}]
		*/

		if ( ! $this->auth() )
		{
			return;
		}
	
		$input_raw = Input::json();
	
		$rules = array(
			'path' => 'required',
			'data' => 'required',
		);

        if ( ! is_array($input_raw))
        {
            $input_raw = array($input_raw);
        }
        foreach ($input_raw as $input)
        {
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
                $ret_message[] = $this->_resultSuccess(self::MSG_UPDATE_SUCCESS);
            }
            else
            {
                $ret_message[] = $this->_resultFail(self::MSG_UPDATE_ERROR);
            }

        }

		return json_encode($ret_message);
	}
}