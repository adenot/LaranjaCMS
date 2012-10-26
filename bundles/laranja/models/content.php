<?php

class LaranjaContent extends LaranjaStorage {
	const PREFIX = 'content$';
	
	static public function get_storage($key) 
	{
		return parent::_get_storage(self::PREFIX, $key);
	}
	
	static public function generate_storage_id($key) 
	{
		return parent::_generate_storage_id(self::PREFIX, $key);
	}
	
	public function save() 
	{
		$this->type = 'content';
		return parent::save();
	}
}