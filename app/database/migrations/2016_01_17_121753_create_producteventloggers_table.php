<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducteventloggersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up()
	{
		Schema::create('producteventloggers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id');
			$table->enum('event',array('add','edit','delete','publish','unpublish'));
			$table->enum('status',array('New','Added','Updated','Deleted','Completed'));
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('producteventloggers');
	}

}
