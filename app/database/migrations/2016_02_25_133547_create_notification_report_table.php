<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationReportTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notification_report', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('notification_id');
			$table->string('seen_by_id');
			$table->string('merchant_status');
			$table->longText('note');
			$table->boolean('status')->default(true);
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
		Schema::drop('notification_report');
	}

}
