<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ShippingPackagesTableSeeder extends Seeder {

	public function run()
	{
      $faker = Faker::create();

      $sameDay=  ShippingPackage::create([
             'label'=>'Same Day(8Hr)',
             'code'=>'1',
              'time'=>8,
            'shippingChannel_id'=>1,
			]);
      $nextDay=  ShippingPackage::create([
          'label'=>'Next Day(48hr)',
          'code'=>'2',
          'time'=>48,
          'shippingChannel_id'=>1,
        ]);
      $nextDayOutside=  ShippingPackage::create([
          'label'=>'Next Day(24hr)',
          'code'=>'5',
          'time'=>24,
          'shippingChannel_id'=>1,
        ]);


    }

}