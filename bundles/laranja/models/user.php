<?php

class LaranjaUser extends Eloquent {
	public static $table = 'laranja_user';
	public static $timestamps = false;
	
	public function storage() {
		return $this->has_one('LaranjaStorage');
	}
}