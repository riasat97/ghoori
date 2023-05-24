<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreStatusEsInPaymentsTableEpitome extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('payments', function(Blueprint $table)
		{
            DB::statement("ALTER TABLE payments MODIFY COLUMN status ENUM('created','canceled','expired','incomplete','completed','in_progress','pending','failed') NOT NULL DEFAULT 'created'");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('payments', function(Blueprint $table)
		{
            DB::statement("ALTER TABLE payments MODIFY COLUMN status ENUM('created','canceled','expired','incomplete','completed') NOT NULL DEFAULT 'created'");
		});
	}

}
