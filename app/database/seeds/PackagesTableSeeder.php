<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PackagesTableSeeder extends Seeder {

	public function run()
	{
        DB::table('packages')->truncate();
      //  DB::statement("SET foreign_key_checks = 0");
        DB::table('packages')->insert(array(
          ['name'=>'starter','price'=>'0','transactionFee'=>'10','type'=>'deprecated'],
          ['name'=>'starter','price'=>'99','transactionFee'=>'8','type'=>'public'],
          ['name'=>'basic','price'=>'299','transactionFee'=>'7','type'=>'public'],
          ['name'=>'premium','price'=>'899','transactionFee'=>'5','type'=>'public'],

      ));

	}

}