<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopsocialnetworksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shopsocialnetworks', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('youtube');
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
		Schema::drop('shopsocialnetworks');
	}

}
