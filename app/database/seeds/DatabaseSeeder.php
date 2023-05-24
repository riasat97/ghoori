<?php

class DatabaseSeeder extends Seeder {


	public function run()
	{
		Eloquent::unguard();


          /*$this->call('AttributesTableSeeder');
          $this->call('PaymentMethodsTableSeeder');
          $this->call('ShippingChannelsTableSeeder');
          $this->call('ShippingPackagesTableSeeder');
          $this->call('ShippingLocationsTableSeeder');
          $this->call('ShippingPackageShippingLocationTableSeeder');
          $this->call('ShippingweightsTableSeeder');
          $this->call('ShippingWeightChargesTableSeeder');

          $this->call('OrderrjectiontypesTableSeeder');
          $this->call('RejectionreasonsTableSeeder');

        $this->call('PackagesTableSeeder');
        $this->call('CampaignsTableSeeder');*/

        // $this->call('ThemesTableSeeder');
        $this->call('PackageProductLimitsTableSeeder');

        /* These are real data */

    /*    $this->call('ShippingPackagesTableSeeder');
        $this->call('ShippingLocationsTableSeeder');
        $this->call('ShippingPackageShippingLocationTableSeeder');
        $this->call('ShippingWeightChargesTableSeeder');
        $this->call('ShippingweightsTableSeeder');
        $this->call('AttributesTableSeeder');
        $this->call('PaymentMethodsTableSeeder');
        $this->call('ShippingChannelsTableSeeder');
        $this->call('ReasonsduringdeliveriesTableSeeder');
        $this->call('ReasonsduringorderplacementsTableSeeder');
        $this->call('PhotographyServicePackagesTableSeeder');
    */

	}

}
