<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddColumnsToJournalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('journals', function(Blueprint $table)
		{
			$table->date('payment_at');
			$table->string('month');
			$table->integer('year');
			$table->string('cycle');
			$table->decimal('subscription_fee',8,2);
			$table->decimal('ownChannelDelivery_fee',8,2);
			$table->decimal('fShop_fee',8,2);

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('journals', function(Blueprint $table)
		{
			$table->dropColumn(array('payment_at','month','year','cycle','subscription_fee','ownChannelDelivery_fee','fShop_fee'));
		});
	}

}
