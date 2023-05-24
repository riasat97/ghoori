<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentmethodShopTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paymentmethod_shop', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('paymentmethod_id')->unsigned()->index();
			$table->foreign('paymentmethod_id')->references('id')->on('paymentmethods')->onDelete('cascade');
			$table->integer('shop_id')->unsigned()->index();
			$table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
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
		Schema::drop('paymentmethod_shop');
	}

}
