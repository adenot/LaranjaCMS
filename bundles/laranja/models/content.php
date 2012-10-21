<?php

class Laranja_Content extends Eloquent {
	public static $table = 'laranja_content';
	public static $timestamps = false;
	
	public function storage() {
		return $this->has_one('LaranjaStorage');
	}
}