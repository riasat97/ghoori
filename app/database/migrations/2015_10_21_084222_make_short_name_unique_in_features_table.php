<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeShortNameUniqueInFeaturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('features', function(Blueprint $table)
		{
			$table->unique('shortName');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('features', function(Blueprint $table)
		{
			$table->dropUnique('shortName');
		});
	}

}
