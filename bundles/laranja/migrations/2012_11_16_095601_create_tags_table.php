<?php

class Laranja_Create_Tags_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('laranja_tags', function($table)
		{
			$table->string('tag', 32)->index();
			$table->string('storage_id', 64)->index();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('laranja_tags');
	}

}