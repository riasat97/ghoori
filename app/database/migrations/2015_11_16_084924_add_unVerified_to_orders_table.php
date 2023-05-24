<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUnVerifiedToOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{
            DB::statement("alter table `orders` modify column `status` enum ('New','Proceed','Reject','Complete','PaymentRequested','PaymentFailed','PaymentTimeOut','Unverified','Suspicious', 'Fake') DEFAULT 'New'");

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
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('New','Proceed','Reject','Complete') DEFAULT 'New'");

        });
	}

}
