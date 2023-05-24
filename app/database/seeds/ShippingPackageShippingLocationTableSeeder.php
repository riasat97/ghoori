<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ShippingPackageShippingLocationTableSeeder extends Seeder {

	public function run()
	{

    DB::table('shippingpackage_shippinglocation')->insert([
        'shippingPackage_id' => 1 ,
        'shippingLocation_id' =>1
    ]);
    DB::table('shippingpackage_shippinglocation')->insert([
        'shippingPackage_id' => 2,
        'shippingLocation_id' => 1
    ]);
    DB::table('shippingpackage_shippinglocation')->insert([
        'shippingPackage_id' =>3 ,
        'shippingLocation_id' =>2
    ]);
        DB::table('shippingpackage_shippinglocation')->insert([
            'shippingPackage_id' => 3 ,
            'shippingLocation_id' =>3
        ]);
        DB::table('shippingpackage_shippinglocation')->insert([
            'shippingPackage_id' => 3,
            'shippingLocation_id' => 4
        ]);
        DB::table('shippingpackage_shippinglocation')->insert([
            'shippingPackage_id' =>3,
            'shippingLocation_id' =>5
        ]);
        DB::table('shippingpackage_shippinglocation')->insert([
            'shippingPackage_id' =>3,
            'shippingLocation_id' =>6
        ]);
        DB::table('shippingpackage_shippinglocation')->insert([
            'shippingPackage_id' =>3 ,
            'shippingLocation_id' =>7
        ]);

    }

}