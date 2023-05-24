<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeUnitCostColumnDecimalInShippingweightchargesTable extends Migration {

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
                Schema::table('shippingweightcharges', function(Blueprint $table) {
                    $table->decimal('unitCost', 12, 2)->change();
                });
                break;
            /**
             * it is not L5 !!
             */
            default :
                DB::statement("ALTER TABLE shippingweightcharges MODIFY unitCost DECIMAL(12,2) NOT NULL;");
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
                Schema::table('shippingweightcharges', function(Blueprint $table) {
                    $table->float('unitCost', 8, 2)->change();
                });
                break;
            /**
             * it is not L5 !!
             */
            default :
                DB::statement("ALTER TABLE shippingweightcharges MODIFY unitCost FLOAT(8,2) NOT NULL;");
        }
    }

}
