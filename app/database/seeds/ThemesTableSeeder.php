<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ThemesTableSeeder extends Seeder {

	public function run()
	{

        Theme::create([
            'name' => 'silver',
            'status' => true,
            'path' => 'themes.theme_1'
        ]);

	}

}