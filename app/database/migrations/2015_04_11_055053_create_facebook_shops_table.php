<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacebookShopsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('facebookshops', function(Blueprint $table)
		{
			$table->increments('id');
            $table->unsignedInteger('shop_id');
            $table->unsignedBigInteger('page_id');
            $table->text('page_access_token');
			$table->timestamps();
		});
	}
	/**6
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('facebookshops');
	}
}