<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPaymentTimeoutOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('orders', function(Blueprint $table)
        {
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('New','Proceed','Reject','Complete','PaymentRequested','PaymentFailed','PaymentTimeOut') DEFAULT 'New'");
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
