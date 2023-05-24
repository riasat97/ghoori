<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShippingpackagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shippingpackages', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('label');
            $table->string('code');
            $table->float('time');
            $table->integer('shippingChannel_id');
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
		Schema::drop('shippingpackages');
	}

}
