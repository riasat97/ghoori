<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakePriceBiggerOrderProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // getting Laravel App Instance
        $app = app();

        // getting laravel main version
        $laravelVer = explode('.',$app::VERSION);

        switch ($laravelVer[0]) {

            case('5') :
                Schema::table('order_product', function(Blueprint $table) {
                    $table->decimal('price', 12, 2)->default(0)->change();
                });
                break;
            /**
             * it is not L5 !!
             */
            default :
                DB::statement("ALTER TABLE order_product MODIFY price DECIMAL(12,2) DEFAULT '0.00' NOT NULL;");
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        // getting Laravel App Instance
        $app = app();

        // getting laravel main version
        $laravelVer = explode('.',$app::VERSION);

        switch ($laravelVer[0]) {

            case('5') :
                Schema::table('order_product', function(Blueprint $table) {
                    $table->decimal('price', 6, 2)->change();
                });
                break;
            /**
             * it is not L5 !!
             */
            default :
                DB::statement("ALTER TABLE order_product MODIFY price DECIMAL(6,2) NOT NULL;");
        }
	}

}
