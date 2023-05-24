<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBkashTransactionsTableOld extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bkash_transactions', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('trx_id',30)->nullable();
            $table->decimal('amount',12,2)->nullable();
            $table->string('counter',10)->nullable();
            $table->string('currency',10)->nullable();
            $table->string('datetime',50)->nullable();
            $table->string('receiver',20)->nullable();
            $table->string('reference',50)->nullable();
            $table->string('sender',20)->nullable();
            $table->string('service',20)->nullable();
            $table->string('trx_status',10)->nullable();
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
		Schema::drop('bkash_transactions');
	}

}
