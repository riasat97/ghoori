<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCampaignShopTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_shop', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('campaign_id')->unsigned()->index();
			$table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
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
		Schema::drop('campaign_shop');
	}

}
