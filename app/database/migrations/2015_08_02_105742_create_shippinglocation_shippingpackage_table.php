<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShippinglocationShippingpackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shippingpackage_shippinglocation', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('shippingPackage_id')->unsigned()->index();
			$table->foreign('shippingPackage_id')->references('id')->on('shippingpackages')->onDelete('cascade');
            $table->integer('shippingLocation_id')->unsigned()->index();
            $table->foreign('shippingLocation_id')->references('id')->on('shippinglocations')->onDelete('cascade');
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
		Schema::drop('shippingpackage_shippinglocation');
	}

}
