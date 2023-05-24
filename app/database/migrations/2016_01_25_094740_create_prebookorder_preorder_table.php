<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrebookorderPreorderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prebookorder_preorder', function(Blueprint $table)
		{	$table->increments('id');
			$table->integer('prebook_order_id')->unsigned();
			$table->integer('preorder_id');
			$table->string('quantity');
			$table->string('preorderName');
			$table->string('discount');
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
