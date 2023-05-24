<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class OrderrjectiontypesTableSeeder extends Seeder {

	public function run()
	{

        DB::table('orderrejectiontypes')->insert(array(
            array('type' => 'during placement'),
            array('type' => 'during delivery'),

        ));
	}

}