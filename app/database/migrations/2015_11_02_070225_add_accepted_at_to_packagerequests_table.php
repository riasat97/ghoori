<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAcceptedAtToPackagerequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('packagerequests', function(Blueprint $table)
		{
            $table->timestamp('accepted_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('packagerequests', function(Blueprint $table)
		{
			$table->dropColumn('accepted_at');
		});
	}

}
