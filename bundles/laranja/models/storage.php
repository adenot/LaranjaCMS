<?php

class LaranjaStorage extends Eloquent {
	public static $table = 'laranja_storage';
	public static $timestamps = true;
	
	public static $key = 'id';
	
	public function set_data($data_array) {
		parent::set_attribute('data', serialize($data_array));
	}

	public function set_meta_data($data_array) {
		parent::set_attribute('meta_data', serialize($data_array));
	}
	
	public function get_data() {
		if (!parent::get_attribute('data')) { return false; }
		
		return unserialize(parent::get_attribute('data'));
	}

	public function get_meta_data() {
		if (!parent::get_attribute('meta_data')) { return false; }
		
		return unserialize(parent::get_attribute('meta_data'));
	}
	
	static public function _get_storage($prefix, $key) 
	{
		return LaranjaStorage::find(self::_generate_storage_id($prefix, $key));
	}
	
	static public function _generate_storage_id($prefix, $key) 
	{
		return md5($prefix.$key);
	}
	
}