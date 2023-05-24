<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PhotographyServicePackagesTableSeeder extends Seeder {

	public function run()
	{
        DB::table('photography_service_packages')->truncate();
      //  DB::statement("SET foreign_key_checks = 0");
        DB::table('photography_service_packages')->insert(array(
          ['name'=>'Package 1','photos'=>'25','price'=>'800'],
          ['name'=>'Package 2','photos'=>'50','price'=>'1400'],
          ['name'=>'Package 3','photos'=>'75','price'=>'2200'],
          ['name'=>'Package 4','photos'=>'100','price'=>'2600'],
          ['name'=>'Package 5','photos'=>'200','price'=>'4500'],

      ));

	}

}