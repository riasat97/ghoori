<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNataiusersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nataiusers', function(Blueprint $table)
		{
			$table->softDeletes();
			$table->string('website')->nullable();
			$table->string('country')->nullable();
			$table->string('gravatar')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropColumn('deleted_at', 'website', 'country', 'gravatar');
		//Schema::drop('nataiusers');
	}

}
