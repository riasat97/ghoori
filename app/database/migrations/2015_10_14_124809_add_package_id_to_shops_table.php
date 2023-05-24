<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPackageIdToShopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shops', function(Blueprint $table)
		{
			$table->integer('package_id')->nullable();
            $table->timestamp('migrated_at');
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
			$table->dropColumn('package_id');
            $table->dropColumn('migrated_at');
		});
	}

}
