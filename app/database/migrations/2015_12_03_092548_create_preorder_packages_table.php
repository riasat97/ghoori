<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreorderPackagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('preorder_packages', function(Blueprint $table)
		{
			$table->increments('preorder_package_id');
			$table->integer('shop_id');
			$table->integer('preorder_id');
			$table->string('preorder_key');
			$table->string('amount');
			$table->string('quantity');
			$table->string('description');
			$table->string('price');
			$table->string('delivery_date');
			$table->string('status');
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
