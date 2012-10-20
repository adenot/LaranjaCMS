<?php

class Laranja_Create_Content_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('laranja_content', function($table) {
			$table->string('path')->primary();
			$table->string('storage_id', 64)->unique();
			
			$table->foreign('storage_id')->references('id')->on('laranja_storage');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('laranja_content');
	}

}