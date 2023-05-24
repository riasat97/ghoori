<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddVerificationInfoToUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->string('nationalId')->nullable();
            $table->string('drivingLicense')->nullable();
            $table->string('passport')->nullable();
            $table->string('birthCertificate')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropColumn('nationalId');
            $table->dropColumn('drivingLicense');
            $table->dropColumn('passport');
            $table->dropColumn('birthCertificate');
        });
    }

}
