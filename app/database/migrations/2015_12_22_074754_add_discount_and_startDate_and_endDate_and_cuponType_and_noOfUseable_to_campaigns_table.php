<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDiscountAndStartDateAndEndDateAndCuponTypeAndNoOfUseableToCampaignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('campaigns', function(Blueprint $table)
		{
			$table->integer('discount')->nullable();
			$table->date('startDate')->nullable();
			$table->date('endDate')->nullable();
			$table->integer('couponType')->nullable();
			$table->integer('noOfUseable')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('campaigns', function(Blueprint $table)
		{
			$table->dropColumn(array('discount','startDate','endDate','couponType','noOfUseable'));
		});
	}

}
