<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDozeTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doze_transactions', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('token',100)->unique();
            $table->string('username')->nullable();
            $table->string('name',100)->nullable();
            $table->decimal('amount',12,2)->nullable();
            $table->string('payment_response_code',10)->nullable();
            $table->enum('status',['token_requested','login_failed','payment_unknown','payment_success','payment_failed'])->default('token_requested');
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
		Schema::drop('doze_transactions');
	}

}
