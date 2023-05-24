<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShippingChannelShopTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shippingchannel_shop', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('shippingChannel_id')->unsigned()->index();
			$table->foreign('shippingChannel_id')->references('id')->on('shippingchannels')->onDelete('cascade');
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
		Schema::drop('shippingchannel_shop');
	}

}
