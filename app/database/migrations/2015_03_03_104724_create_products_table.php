<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 50);
            //	$table->string('sku', 50);
            $table->text('description');
            $table->float('price');
            //$table->float('stock');
            $table->enum('status',array('Published', 'Unpublished'))->default('Unpublished');
            $table->integer('category_id')->unsigned();
            $table->integer('subcategory_id')->unsigned();
            $table->integer('subSubCategory_id')->unsigned();
            //$table->integer('brand_id')->unsigned();
            $table->integer('shop_id')->unsigned();
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
        Schema::drop('products');
    }

}
