<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotedItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promoted_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title',100);
            $table->string('subtitle',100)->nullable();
            $table->string('shortDescription',170)->nullable();
            $table->integer('productId');
            $table->string('url');
            $table->string('image',100);
            $table->enum('position',['large_ad','medium_ad','small_ad']);
            $table->enum('group',['for_her','for_him','for_kids','gadgets','home_and_decor']);
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
		Schema::drop('promoted_items');
	}

}
