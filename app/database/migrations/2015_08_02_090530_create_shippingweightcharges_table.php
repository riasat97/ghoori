<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShippingweightchargesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shippingweightcharges', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('shippingPackage_shippingLocation_id');
            $table->integer('shippingWeight_id');
            $table->float('unitCost');
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
		Schema::drop('shippingweightcharges');
	}

}
