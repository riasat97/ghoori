<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AttributesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$size=	Attribute::create([
            'type'=>'color',

			]);
        $color=	Attribute::create([
            'type'=>'size',

        ]);

	}

}