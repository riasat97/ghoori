<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ShippingChannelsTableSeeder extends Seeder {

	public function run()
	{
       $ecourier=ShippingChannel::create([
            'name'=>'ecourier'
			]);
	}

}