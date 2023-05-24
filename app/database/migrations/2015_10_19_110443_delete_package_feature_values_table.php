<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeletePackageFeatureValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::drop('package_feature_values');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::create('package_feature_values', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('package_feature_id')->index();
            $table->string('key' , 50)->index();
            $table->string('value' , 50);
            $table->timestamps();
        });
	}

}