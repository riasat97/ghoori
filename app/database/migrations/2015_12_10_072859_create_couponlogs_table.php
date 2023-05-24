<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponlogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('couponlogs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('couponId');
			$table->integer('shop_id');
			$table->integer('user_id');
			$table->enum('status',array('Accept','Reject'));
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
		Schema::drop('couponlogs');
	}

}
