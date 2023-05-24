<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePackagerequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('packagerequests', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('shop_id');
            $table->integer('package_id');
            $table->integer('oldPackage_id')->nullable();
            $table->enum('status',array('pending','accepted','rejected'))->default('pending');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('packagerequests');
	}

}
