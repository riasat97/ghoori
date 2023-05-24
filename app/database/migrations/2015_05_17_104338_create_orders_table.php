<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{	$table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('shop_id');
            $table->integer('shippingPackage_id')->nullable();
            $table->integer('paymentMethod_id');
            $table->decimal('total', 6, 2);
            $table->integer('status_id')->unsigned()->default(0);
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
		Schema::drop('orders');
	}

}
