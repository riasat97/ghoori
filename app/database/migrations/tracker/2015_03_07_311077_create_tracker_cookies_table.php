<?php

use PragmaRX\Support\Migration;

class CreateTrackerCookiesTable extends Migration {

	/**
	 * Table related to this migration.
	 *
	 * @var string
	 */

	private $table = 'tracker_cookies';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function migrateUp()
	{
        Schema::connection('tracker')->create(
			$this->table,
			function ($table)
			{
				$table->bigIncrements('id');

				$table->string('uuid')->unique();

				$table->timestamp('created_at')->index();
				$table->timestamp('updated_at')->index();
			}
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function migrateDown()
	{
		$this->drop($this->table);
	}

}
