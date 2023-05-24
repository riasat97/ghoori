<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeEmailColumnNotNullUniqueUsersTable extends Migration {

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
                    $table->string('email',100)->unique()->change();
                });
                break;
            /**
             * it is not L5 !!
             */
            default :
                DB::statement("ALTER TABLE users MODIFY email VARCHAR(100) NOT NULL;");
                Schema::table('users', function(Blueprint $table) {
                    $table->unique('email');
                });
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
                    $table->string('email',100)->nullable()->default(null)->change();
                });
                break;
            /**
             * it is not L5 !!
             */
            default :
                DB::statement("ALTER TABLE users MODIFY email VARCHAR(100) NULL;");
                Schema::table('users', function(Blueprint $table) {
                    $table->dropUnique('users_email_unique');
                });
        }
    }

}