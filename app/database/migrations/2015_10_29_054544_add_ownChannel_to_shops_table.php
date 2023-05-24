<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOwnChannelToShopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shops', function(Blueprint $table)
		{
			$table->boolean('ownChannel')->default(false);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shops', function(Blueprint $table)
		{
		  $table->dropColumn('ownChannel');
		});
	}

}
