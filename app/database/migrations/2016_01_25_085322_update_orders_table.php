<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			DB::statement("alter table `orders` modify column `status` enum ('New','Proceed','Reject','Complete','Suspicious', 'Fake','PaymentFailed','PaymentRequested','PaymentTimeOut','Unverified','TestOrder','ProductReturn','OrderCancel') DEFAULT 'New';");
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
			$table->enum('status',array('New','Proceed','Reject','Complete','Suspicious', 'Fake','PaymentFailed','PaymentRequested','PaymentTimeOut','Unverified'))->default('New');
		});
	}

}
