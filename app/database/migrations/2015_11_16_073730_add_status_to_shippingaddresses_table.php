<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddStatusToShippingaddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shippingaddresses', function(Blueprint $table)
		{
         $table->boolean('status')->default(false);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shippingaddresses', function(Blueprint $table)
		{
			$table->dropColumn('status');
		});
	}

}
