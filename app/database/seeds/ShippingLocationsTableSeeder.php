<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ShippingLocationsTableSeeder extends Seeder {

	public function run()
    {
        $dhaka = ShippingLocation::create([
            'name' => 'Dhaka'
        ]);
        $chittagong = ShippingLocation::create([
            'name' => 'Chittagong'
        ]);
        $sylhet = ShippingLocation::create([
            'name' => 'Sylhet'
        ]);
        $Barisal = ShippingLocation::create([
            'name'=> 'Barisal'
        ]);
        $Khulna= ShippingLocation::create([
            'name'=>'Khulna'
        ]);
        $Rajshahi= ShippingLocation::create([
            'name'=>'Rajshahi'
        ]);
        $Rangpur= ShippingLocation::create([
            'name'=>'Rangpur'
        ]);

    }
}