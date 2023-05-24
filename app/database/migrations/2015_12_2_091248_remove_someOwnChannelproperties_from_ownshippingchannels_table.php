<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveSomeOwnChannelpropertiesFromOwnshippingchannelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ownshippingchannels', function(Blueprint $table)
		{
			$table->dropColumn('oldOwnChannel');
            $table->dropColumn('status');
            $table->dropColumn('accepted_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ownshippingchannels', function(Blueprint $table)
		{

		});
	}

}
