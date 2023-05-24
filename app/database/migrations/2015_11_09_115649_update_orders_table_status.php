<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateOrdersTableStatus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			DB::statement("alter table `orders` modify column `status` enum ('New','Proceed','Reject','Complete','PaymentRequested','PaymentFailed','Suspicious', 'Fake') DEFAULT 'New';");
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
            DB::statement("alter table `orders` modify column `status` enum ('New','Proceed','Reject','Complete') DEFAULT 'New';");
		});
	}
}
