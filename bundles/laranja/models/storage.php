<?php

class Laranja_Storage extends Eloquent {
	public static $table = 'laranja_storage';
	public static $timestamps = true;
	
	public function user() {
		return $this->has_one('Laranja_User', 'storage_id');
	}
	
	public function content() {
		return $this->has_one('Laranja_Content', 'storage_id');
	}
	
	public function set_data($data_array) {
		parent::set_attribute('data', serialize($data_array));
	}
	
	public function get_data() {
		if (!parent::get_attribute('data')) { return false; }
		
		return unserialize(parent::get_attribute('data'));
	}
	
}