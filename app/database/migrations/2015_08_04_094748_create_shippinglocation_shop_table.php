<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShippinglocationShopTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shop_shippinglocation', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('shop_id')->unsigned()->index();
			$table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->integer('shippinglocation_id')->unsigned()->index();
            $table->foreign('shippinglocation_id')->references('id')->on('shippinglocations')->onDelete('cascade');
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
		Schema::drop('shop_shippinglocation');
	}

}
