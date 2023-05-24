<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveReasonsduringplacementanddeliveryFromOrderrejectionreasonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orderrejectionreasons', function(Blueprint $table)
		{
            $table->dropColumn('reasonsduringdelivery_id')->nullable();
            $table->dropColumn('reasonsduringorderplacement_id')->nullable();

            $table->integer('rejectionreason_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orderrejectionreasons', function(Blueprint $table)
		{
            $table->dropColumn('rejectionreason_id')->nullable();
		});
	}

}
