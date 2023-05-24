<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PaymentMethodsTableSeeder extends Seeder {

	public function run()
	{
        DB::table('paymentmethods')->truncate();

        $cod = PaymentMethod::create(
            array(
                'label'=>'Cash on Delivery',
                'charge'=>0,
                'provider'=>''
            )
        );
        $card=  PaymentMethod::create(
            array(
                'label'=>'Card',
                'charge'=>0,
                'provider'=>''
            )
        );
	}

}