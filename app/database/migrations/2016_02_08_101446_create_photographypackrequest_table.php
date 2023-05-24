<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotographypackrequestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photographypackrequest', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('shop_id');
            $table->integer('photography_service_package_id');
			$table->enum('status',array('new','completed','rejected'))->default('new');
            $table->decimal('subtotal',12,2)->default(0);
            $table->decimal('vat',12,2)->default(0);
            $table->decimal('total',12,2)->default(0);
			$table->boolean('isPaid')->default(false);
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
		Schema::drop('photographypackrequest');
	}

}
