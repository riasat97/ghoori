<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameConfirmationColumnsInShopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shops', function(Blueprint $table)
		{
            $table->dropColumn('emailConfirmed');
            $table->dropColumn('emailConfirmationCode');
            $table->boolean('emailVerified')->default(0);
            $table->string('emailVerificationCode')->nullable();
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
            $table->dropColumn('emailVerified');
            $table->dropColumn('emailVerificationCode');
            $table->boolean('emailConfirmed')->default(0);
            $table->string('emailConfirmationCode')->nullable();
		});
	}
}