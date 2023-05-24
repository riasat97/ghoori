<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class RejectionreasonsTableSeeder extends Seeder {

	public function run()
	{
        DB::table('rejectionreasons')->insert(array(
            array('reason' => 'I mistakenly ordered a wrong product','orderrejectiontype_id'=>'1'),
            array('reason' => 'I did not understand that i ordered wrong quantity','orderrejectiontype_id'=>'1'),
            array('reason' => 'I though i need it but actually don’t','orderrejectiontype_id'=>'1'),
            array('reason' => 'Product quality is confusing','orderrejectiontype_id'=>'1'),
            array('reason' => 'Merchant information is not available','orderrejectiontype_id'=>'1'),
            array('reason' => 'I do not trust this merchant','orderrejectiontype_id'=>'1'),
            array('reason' => 'Out of my budget','orderrejectiontype_id'=>'1'),
            array('reason' => 'I wont be available during delivery period','orderrejectiontype_id'=>'1'),
            array('reason' => 'I choose a wrong order','orderrejectiontype_id'=>'1'),
            array('reason' => 'I dont want this product','orderrejectiontype_id'=>'1'),

            array('reason' => 'I did not get what i wanted','orderrejectiontype_id'=>'2'),
            array('reason' => 'Product quality is not up to the mark','orderrejectiontype_id'=>'2'),
            array('reason' => 'Did not receive the product on time','orderrejectiontype_id'=>'2'),
            array('reason' => 'Did not want to order it. It was a mistake','orderrejectiontype_id'=>'2'),
        ));
	}

}