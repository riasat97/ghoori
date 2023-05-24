<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class shippingweightchargesTableSeeder extends Seeder {

	public function run()
	{

        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 1 ,
            'shippingWeight_id' =>1,
            'unitCost'=>100
        ]);
        DB::table('shippingweightcharges')->insert([
        'shippingPackage_shippingLocation_id' => 1 ,
        'shippingWeight_id' =>2,
        'unitCost'=>120
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 1 ,
            'shippingWeight_id' =>3,
            'unitCost'=>140
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 2,
            'shippingWeight_id' =>1,
            'unitCost'=>50
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 2,
            'shippingWeight_id' =>2,
            'unitCost'=>70
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 2,
            'shippingWeight_id' =>3,
            'unitCost'=>100
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 3,
            'shippingWeight_id' =>1,
            'unitCost'=>100
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 3,
            'shippingWeight_id' =>2,
            'unitCost'=>120
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 3,
            'shippingWeight_id' =>3,
            'unitCost'=>150
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 4,
            'shippingWeight_id' =>1,
            'unitCost'=>100
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 4,
            'shippingWeight_id' =>2,
            'unitCost'=>120
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 4,
            'shippingWeight_id' =>3,
            'unitCost'=>150
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 5,
            'shippingWeight_id' =>1,
            'unitCost'=>100
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 5,
            'shippingWeight_id' =>2,
            'unitCost'=>120
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 5,
            'shippingWeight_id' =>3,
            'unitCost'=>150
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 6,
            'shippingWeight_id' =>1,
            'unitCost'=>100
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 6,
            'shippingWeight_id' =>2,
            'unitCost'=>120
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 6,
            'shippingWeight_id' =>3,
            'unitCost'=>150
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 7,
            'shippingWeight_id' =>1,
            'unitCost'=>100
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 7,
            'shippingWeight_id' =>2,
            'unitCost'=>120
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 7,
            'shippingWeight_id' =>3,
            'unitCost'=>150
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 8,
            'shippingWeight_id' =>1,
            'unitCost'=>100
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 8,
            'shippingWeight_id' =>2,
            'unitCost'=>120
        ]);
        DB::table('shippingweightcharges')->insert([
            'shippingPackage_shippingLocation_id' => 8,
            'shippingWeight_id' =>3,
            'unitCost'=>150
        ]);

	}

}