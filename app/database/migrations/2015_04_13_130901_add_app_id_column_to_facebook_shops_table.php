<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAppIdColumnToFacebookShopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('facebookshops', function(Blueprint $table)
		{
			$table->unsignedBigInteger('app_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('facebookshops', function(Blueprint $table)
		{
			$table->removeColumn('app_id');
		});
	}

}
