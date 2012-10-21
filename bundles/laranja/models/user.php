<?php

class Laranja_User extends Eloquent {
	public static $table = 'laranja_user';
	public static $timestamps = false;
	
	public function storage() {
		return $this->belongs_to('Laranja_Storage', 'storage_id');
	}
}