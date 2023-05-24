<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJournalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('journals', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('shop_id');
			$table->decimal('amount',12,2);
			$table->enum('status',array('Pending', 'Paid', 'Received'))->default('Pending');
			$table->integer('medium')->nullable();
			$table->string('mediumId')->nullable();
			$table->integer('channel');
			$table->string('transactionId');
			$table->string('file_name')->nullable();
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
		Schema::drop('journals');
	}

}
