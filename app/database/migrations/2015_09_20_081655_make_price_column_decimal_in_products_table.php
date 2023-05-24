<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakePriceColumnDecimalInProductsTable extends Migration {

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
                Schema::table('products', function(Blueprint $table) {
                    $table->decimal('price', 12, 2)->change();
                });
                break;
            /**
             * it is not L5 !!
             */
            default :
                DB::statement("ALTER TABLE products MODIFY price DECIMAL(12,2) NOT NULL;");
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
                Schema::table('products', function(Blueprint $table) {
                    $table->float('price', 8, 2)->change();
                });
                break;
            /**
             * it is not L5 !!
             */
            default :
                DB::statement("ALTER TABLE products MODIFY price FLOAT(8,2) NOT NULL;");
        }
	}

}
