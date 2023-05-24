<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsoredItemDatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sponsored_item_dates', function(Blueprint $table)
		{
            $table->increments('id');
            $table->date('date');
            $table->integer('sponsored_item_id');
            $table->enum('position',['large_ad','medium_ad','small_ad']);
            $table->enum('group',['for_her','for_him','for_kids','gadgets','home_and_decor']);
            $table->softDeletes();
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
		Schema::drop('sponsored_item_dates');
	}

}
