<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddEndedAtToWinterishereTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('winterishere', function(Blueprint $table)
		{
			$table->timestamp('ended_at')->nullable()->after('status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('winterishere', function(Blueprint $table)
		{
			$table->dropColumn('ended_at');
		});
	}

}
