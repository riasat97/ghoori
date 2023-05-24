<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUserTableMakeFbIdNullable extends Migration {

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
                Schema::table('users', function(Blueprint $table) {
                    $table->bigInteger('fbId')->unique()->nullable()->default(null)->change();
                });
                break;
            /**
             * it is not L5 !!
             */
            default :
                DB::statement("ALTER TABLE users MODIFY fbId BIGINT(20) NULL;");
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
                Schema::table('users', function(Blueprint $table) {
                    $table->bigInteger('fbId')->unique()->change();
                });
                break;
            /**
             * it is not L5 !!
             */
            default :
                DB::statement("ALTER TABLE users MODIFY fbId BIGINT(20) NOT NULL;");
        }
	}

}
