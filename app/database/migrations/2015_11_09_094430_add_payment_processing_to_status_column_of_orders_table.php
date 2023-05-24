<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentProcessingToStatusColumnOfOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('=orders', function(Blueprint $table)
		{
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('New','Proceed','Reject','Complete','PaymentRequested','PaymentFailed') DEFAULT 'New'");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('=orders', function(Blueprint $table)
		{
            DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('New','Proceed','Reject','Complete') DEFAULT 'New'");
		});
	}

}
