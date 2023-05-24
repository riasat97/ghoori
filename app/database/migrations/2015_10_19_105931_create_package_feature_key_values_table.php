<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageFeatureKeyValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('package_feature_key_values', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('package_feature_id')->unsigned()->nullable()->index();
            $table->string('key' , 50)->index();
            $table->string('value' , 50);
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
		Schema::drop('package_feature_key_values');
	}

}
