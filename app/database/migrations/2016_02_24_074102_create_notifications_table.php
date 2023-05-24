<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_name');
			$table->string('mobile_no');
			$table->string('preferred_time');
			$table->string('question');
			$table->string('shop_name');
			$table->string('shop_id');
			$table->longText('reason');
			$table->string('seen_by');
			$table->boolean('is_seen')->default(false);
			$table->boolean('is_read')->default(false);
			$table->boolean('status')->default(true);
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
		Schema::drop('notifications');
	}

}
