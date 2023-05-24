<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderrejectionreasons extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orderrejectionreasons', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('order_id');
            $table->integer('reasonsduringdelivery_id')->nullable();
            $table->integer('reasonsduringorderplacement_id')->nullable();
            $table->text('reason')->nullable();
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
		Schema::drop('orderrejectionreasons');
	}

}
