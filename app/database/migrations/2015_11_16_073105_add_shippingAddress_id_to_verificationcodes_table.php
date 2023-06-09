<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddShippingAddressIdToVerificationcodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('verificationcodes', function(Blueprint $table)
		{
			$table->integer('shippingAddress_id')->after('shop_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('verificationcodes', function(Blueprint $table)
		{
			$table->dropColumn('shippingAddress_id');
		});
	}

}
