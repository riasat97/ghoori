<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ShippingweightsTableSeeder extends Seeder {

	public function run()
	{

        $ecourierWeightType_1 =ShippingWeight::create([
        'title'=>'Below 500gm',
         'min'=>0,
          'max'=>500,
            'shippingChannel_id'=>1

        ]);
        $ecourierWeightType_2 =ShippingWeight::create([
            'title'=>'>500gms up to 1kg',
            'min'=>501,
            'max'=>1000,
            'shippingChannel_id'=>1

        ]);
        $ecourierWeightType_3 =ShippingWeight::create([
            'title'=>'>up to 2kg',
            'min'=>1001,
            'max'=>2000,
            'shippingChannel_id'=>1

        ]);
	}

}