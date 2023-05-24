<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreordersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('preorders', function(Blueprint $table)
		{
			$table->increments('preorder_id');
			$table->integer('shop_id');
			$table->string('preorder_key');
			$table->string('name');
			$table->string('description');
			$table->string('price');
			$table->string('quantity');
			$table->string('status');
			$table->string('product_url');
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
