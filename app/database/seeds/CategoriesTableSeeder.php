<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 5) as $index)
		{
			Category::create([
                'name'=>$faker->company
               // 'parent_id'=>rand(1,5)


			]);
		}
	}

}