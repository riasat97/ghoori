<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TotalColumnBiggerInOrdersTable extends Migration {

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
                Schema::table('orders', function(Blueprint $table) {
                    $table->decimal('total', 12, 2)->change();
                });
                break;
            /**
             * it is not L5 !!
             */
            default :
                DB::statement("ALTER TABLE orders MODIFY total DECIMAL(12,2) NOT NULL;");
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
                Schema::table('orders', function(Blueprint $table) {
                    $table->decimal('total', 6, 2)->change();
                });
                break;
            /**
             * it is not L5 !!
             */
            default :
                DB::statement("ALTER TABLE orders MODIFY total DECIMAL(6,2) NOT NULL;");
        }
	}

}
