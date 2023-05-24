<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class CampaignsTableSeeder extends Seeder {

	public function run()
	{
        DB::table('campaigns')->insert(array(
            array('id'=>2, 'name' => 'winter campaign 15','className'=>'WinterCampaign15','active'=>1,'created_at'=>
            \Carbon\Carbon::now()->toDateTimeString()),
            array('id'=>3, 'name' => 'winter campaign 20','className'=>'WinterCampaign20','active'=>1,'created_at'=>
                \Carbon\Carbon::now()->toDateTimeString()),
            array('id'=>4, 'name' => 'winter campaign 30','className'=>'WinterCampaign30','active'=>1,'created_at'=>
                \Carbon\Carbon::now()->toDateTimeString()),
            array('id'=>5, 'name' => 'winter campaign 40','className'=>'WinterCampaign40','active'=>1,'created_at'=>
                \Carbon\Carbon::now()->toDateTimeString()),
            array('id'=>6, 'name' => 'winter campaign 50','className'=>'WinterCampaign50','active'=>1,'created_at'=>
                \Carbon\Carbon::now()->toDateTimeString()),

        ));
	}

}