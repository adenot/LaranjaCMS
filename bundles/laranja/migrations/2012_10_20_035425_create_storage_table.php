<?php

class Laranja_Create_Storage_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('laranja_storage', function($table) {
			$table->string('id', 64)->primary()->unique();
			$table->string('type', 64)->index();
			$table->blob('data');
			$table->blob('meta_data');
			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('laranja_storage');
	}

}