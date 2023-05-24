<?php

use Carbon\Carbon;
use Chorki\shops\Models\Shop;

class PackageMigrationController extends \PackagesController {

    protected $status='accepted';
    public function index($slug)
    {
        if( Input::get('do') == 1 ) {
              $shops=Shop::whereNull('package_id')->get();
                foreach($shops as $key=>$shop){
                    $shop->package_id='1';
                    $shop->migrated_at=$shop->created_at;
                    $shop->save();
                    $this->logPackageRequest($shop);
                }
                return 'Migrated Successfully';
            }
            else {
                return 'Migrate param needed';
            }
    }

    private function logPackageRequest($shop)
    {
        $packageRequest=new PackageRequest();
        $oldId=null;
        $packageRequest->package_id=$shop->package_id;
        $packageRequest->oldPackage_id=$oldId;
        $packageRequest->status=$this->status;
        $packageRequest->shop()->associate($shop);
        $packageRequest->created_at=$shop->created_at;
        $packageRequest->updated_at=$shop->created_at;
        $packageRequest->accepted_at=$shop->created_at;
        $packageRequest->save();
        return $packageRequest;
    }
    public function postMigrateAllPendingPackagesToAcceptedStatus(){
        $now = Carbon::now()->startOfDay()->subHours(6)->addSeconds(1)->toDateTimeString();
        $nowold = Carbon::now()->startOfDay()->subHours(6)->toDateTimeString();
        $pendingPackages= $this->packageRequest->getPendingPackages();
        foreach($pendingPackages as $key=>$pendingPackage){
            if($pendingPackage->accepted_at < $nowold ) {
                $pendingPackage->status='accepted';
                $pendingPackage->accepted_at= $now;
                $pendingPackage->update();
                $shop=$this->shops->getById($pendingPackage->shop_id);
                $shop->package_id=$pendingPackage->package_id;
                $shop->migrated_at=$now;
                $shop->update();
                echo $pendingPackage->shop_id.",<br>";
            }
        }
        return 'successfully migrated';
    }




    public function postUpdateAcceptedPackagesAcceptedAtDate(){
        $packageRequests=PackageRequest::where('status','accepted')->where('package_id','!=',1)->get();

        foreach($packageRequests as $key=>$packageRequest){
            $shop=$this->shops->getById($packageRequest->shop_id);
            $accepted_at=$shop->migrated_at;
            $packageRequest->accepted_at=$accepted_at;
            $packageRequest->update();

        }
        return 'accepted at updated successfully ';
    }

    public function tempPendingPackagesToAcceptedStatus(){
        $now = '2015-11-30 18:00:01';
        // $pendingPackages= $this->packageRequest->getPendingPackages()->where('created_at','<',$now);
        $pendingPackages= PackageRequest::where('created_at','<',$now)->where('status','pending')->get();
        // dd($pendingPackages);
        
        foreach($pendingPackages as $key=>$pendingPackage){
            var_dump($pendingPackage->status);
            $pendingPackage->status         ='accepted';
            $pendingPackage->accepted_at    = $now;
            $pendingPackage->update();

            $shop                           = $this->shops->getById($pendingPackage->shop_id);
            $shop->package_id               = $pendingPackage->package_id;
            $shop->migrated_at              = $now;
            $shop->update();
        }
        return 'successfully migrated';
    }


}