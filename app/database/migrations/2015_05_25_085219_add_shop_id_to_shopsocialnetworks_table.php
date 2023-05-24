<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddShopIdToShopsocialnetworksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shopsocialnetworks', function(Blueprint $table)
		{
			$table->integer('shop_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shopsocialnetworks', function(Blueprint $table)
		{
			$table->dropColumn('shop_id');
		});
	}

}
