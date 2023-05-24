<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTempKeyToLogosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('logos', function(Blueprint $table)
		{
			$table->string('tempKey');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('logos', function(Blueprint $table)
		{
			$table->dropColumn(array('tempKey'));
		});
	}

}
