<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEasyPayWayTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('easy_pay_way_transactions', function(Blueprint $table)
		{
			$table->increments('id');
            $table->decimal('requested_amount',12,2);
            $table->string('epw_txnid',67)->nullable();
            $table->string('mer_txnid',67)->unique();
            $table->decimal('amount',12,2)->nullable();
            $table->enum('pay_status',['Failed','Successful','Unknown'])->default('Unknown');
            $table->string('cardnumber',67)->nullable();
            $table->string('payment_processor',67)->nullable();
            $table->string('bank_trxid',67)->nullable();
            $table->string('payment_type',67)->nullable();
            $table->string('error_code',67)->nullable();
            $table->string('error_title',67)->nullable();
            $table->string('bin_country',67)->nullable();
            $table->string('bin_issuer',67)->nullable();
            $table->string('bin_cardtype',67)->nullable();
            $table->string('bin_cardcategory',67)->nullable();
            $table->dateTime('date_processed')->nullable();
            $table->decimal('rec_amount',12,2)->nullable();
            $table->decimal('processing_ratio',12,2)->nullable();
            $table->decimal('processing_charge',12,2)->nullable();
            $table->string('ip',67)->nullable();
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
		Schema::drop('easy_pay_way_transactions');
	}

}
