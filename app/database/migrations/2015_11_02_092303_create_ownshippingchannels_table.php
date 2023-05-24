<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOwnshippingchannelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ownshippingchannels', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('shop_id');
            $table->integer('ownChannel');
            $table->integer('oldOwnChannel')->nullable();
            $table->enum('status',array('pending','accepted','rejected'))->default('pending');
            $table->timestamp('accepted_at')->nullable();
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
		Schema::drop('ownshippingchannels');
	}

}
