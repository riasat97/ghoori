<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentDateAndCostToSponsoredItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sponsored_items', function(Blueprint $table)
		{
			$table->timestamp('payment_at');
            $table->decimal('cost', 12, 2);
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
			$table->dropColumn('payment_at');
			$table->dropColumn('cost');
		});
	}

}
