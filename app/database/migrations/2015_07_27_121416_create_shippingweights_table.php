<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShippingweightsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shippingweights', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('title');
            $table->string('min');
            $table->string('max');
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
		Schema::drop('shippingweights');
	}

}
