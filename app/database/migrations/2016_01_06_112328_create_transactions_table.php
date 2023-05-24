<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('token',66)->unique();
            $table->enum('status',array('created','requested','pending_verification','completed','failed'))->default('created');
            $table->decimal('amount',12,2)->nullable();
            $table->integer('payment_id');
            $table->integer('transactionable_id');
            $table->string('transactionable_type',100);
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
		Schema::drop('transactions');
	}

}
