<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shops', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 50);
			$table->text('description');
			$table->text('address');
			$table->string('email', 50);
			$table->integer('mobile');
			/*$table->integer('code');*/
           /* $table->string('logo',30);*/
           /* $table->integer('division_id');*/
            $table->enum('status',array('Published', 'Unpublished'))->default('Unpublished');
            $table->integer('user_id');

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
		Schema::drop('shops');
	}

}
