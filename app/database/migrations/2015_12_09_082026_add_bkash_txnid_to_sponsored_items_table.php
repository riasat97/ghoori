<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBkashTxnidToSponsoredItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sponsored_items', function(Blueprint $table)
		{
			$table->string('bkash_txnid',100)->unique()->nullable();
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
			$table->dropColumn('bkash_txnid');
		});
	}

}
