<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrebookOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prebook_orders', function(Blueprint $table)
		{	$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('shop_id');
			$table->integer('paymentMethod_id');
			$table->decimal('total', 12, 2);
			$table->string('status')->default('Unverified');
			$table->integer('shippingLocation_id');
			$table->decimal('shippingCharge',12,2)->nullable();
			$table->timestamp('completed_at');
			$table->decimal('subtotal', 12, 2);
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
		//
	}

}
