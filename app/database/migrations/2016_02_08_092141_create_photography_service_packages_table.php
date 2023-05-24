<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotographyServicePackagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photography_service_packages', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name',60);
            $table->integer('photos')->default(0);
            $table->decimal('price',12,2);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('photography_service_packages');
	}

}
