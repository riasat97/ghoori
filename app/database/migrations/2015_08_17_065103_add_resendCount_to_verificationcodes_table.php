<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddResendCountToVerificationcodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('verificationcodes', function(Blueprint $table)
		{
			$table->integer('resendCount');
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
			$table->dropColumn('resendCount');
		});
	}

}
