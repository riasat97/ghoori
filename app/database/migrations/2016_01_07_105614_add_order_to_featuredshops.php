<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderToFeaturedshops extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('featuredshops', function(Blueprint $table)
		{
			$table->integer('order')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('featuredshops', function(Blueprint $table)
		{
			$table->dropColumn('order');
		});
	}

}
