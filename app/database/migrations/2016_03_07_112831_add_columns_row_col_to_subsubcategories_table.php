<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsRowColToSubsubcategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('subsubcategories', function(Blueprint $table)
		{
			$table->integer('row');
			$table->integer('col');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('subsubcategories', function(Blueprint $table)
		{
			$table->dropColumn('row');
			$table->dropColumn('col');
		});
	}

}
