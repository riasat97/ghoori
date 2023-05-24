<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMerchantReceivedAndGhooriReceivedAndPaymentStatusColumnToOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->decimal('merchantReceived',8,2);
			$table->decimal('ghooriReceived',8,2);
			$table->enum('paymentStatus',array('Received','Paid','Pending'))->default('Pending');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->dropColumn(array('merchantReceived','ghooriReceived','paymentStatus'));
		});
	}

}
