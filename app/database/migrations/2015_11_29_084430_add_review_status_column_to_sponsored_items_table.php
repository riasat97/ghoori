<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReviewStatusColumnToSponsoredItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sponsored_items', function(Blueprint $table)
		{
			$table->enum('reviewStatus',['pending','accepted','denied'])->default('pending');
            $table->string('reviewComment',160)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sponsored_items', function(Blueprint $table)
		{
			$table->removeColumn('reviewStatus');
            $table->removeColumn('reviewComment');
		});
	}

}
