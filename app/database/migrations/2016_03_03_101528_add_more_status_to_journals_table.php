<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreStatusToJournalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('journals', function(Blueprint $table)
		{
			
			DB::statement("alter table `journals` modify column `status` enum ('Pending', 'Paid', 'Received') DEFAULT 'Pending';");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('journals', function(Blueprint $table)
		{
			DB::statement("alter table `journals` modify column `status` enum ('Pending', 'Paid', 'Received') DEFAULT 'Pending';");
		});
	}

}
