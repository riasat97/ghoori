<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentStatusColumnToSponsoredItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sponsored_items', function(Blueprint $table)
		{
			$table->enum('paymentStatus',['Unpaid','Paid','Pending'])->default('Unpaid');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sponsored_items', function(Blueprint $table)
		{
			$table->dropColumn('paymentStatus');
		});
	}

}
