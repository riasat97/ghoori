<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOrderIdToGeneralStatusesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('generalstatuses', function(Blueprint $table)
		{
			$table->bigInteger('order_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('generalStatuses', function(Blueprint $table)
		{
			$table->dropColumn('order_id');
		});
	}

}
