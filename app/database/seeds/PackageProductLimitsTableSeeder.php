<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PackageProductLimitsTableSeeder extends Seeder {

	public function run()
	{
		$productLimit= ['1'=>'24','2'=>'120','3'=>'240','4'=>'2400'];
        foreach ($productLimit as $id=>$productLim) {
            $package=Package::find($id);
            $package->productLimit = $productLim;
            $package->update();
        }

    }

}