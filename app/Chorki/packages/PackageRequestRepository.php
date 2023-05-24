<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 10/26/2015
 * Time: 1:32 PM
 */

namespace Chorki\packages;

use Chorki\GeneralStatusRepository;
use Chorki\Repositories\BaseRevenueRepository;
use Chorki\shops\Models\ShopRepositoryInterface;
use Illuminate\Support\Facades\Config;

class PackageRequestRepository extends BaseRevenueRepository{

    private $packageRequest;
    protected $shop;
    protected $status='pending';
    protected $generalStatusRepository;

    function __construct(\PackageRequest $packageRequest,ShopRepositoryInterface $shop,
                         GeneralStatusRepository $generalStatusRepository){

        $this->packageRequest = $packageRequest;
        $this->shop = $shop;
        $this->generalStatusRepository = $generalStatusRepository;
    }
    public function store($id){
        $shop=$this->shop->_getShop();
        $oldId=$this->getOldPackage($shop);
        $this->packageRequest->package_id=$id;
        $this->packageRequest->oldPackage_id=$oldId;
        $this->packageRequest->status=$this->status;
        $this->packageRequest->shop()->associate($shop);
        $this->packageRequest->save();
        return $this->packageRequest;
    }

    private function getOldPackage($shop)
    {
        return $shop->package_id;
    }
    public function getPendingPackages(){
      return  $this->packageRequest->where('status','pending')->get();
    }
    public function getTotalSubscriptionFeeFromPackageRequest($date,$shop){

        $packageRequest=$this->getLatestPackageFromPackageRequest($date,$shop);

        $price= $packageRequest?$packageRequest->package->price : 0 ;
        $vat= Config::get('vat.rate');
        $priceIncludingVat= $price+($price*$vat);
        return $packageRequest?$priceIncludingVat/2:0;
    }

    public function getLatestPackageFromPackageRequest($date,$shop){
        $packageRequest=$this->packageRequest
            ->with('package')
            ->where('shop_id',$shop->id)
            ->where('status','accepted')
            ->whereNotNull('accepted_at')
            ->where('accepted_at','<=',$date)
            ->orderBy('accepted_at','desc')
            ->first();
        return $packageRequest;
    }
    public function getCheckLatestPackageIsPremium($date,$shop){


        $packageRequest=$this->getLatestPackageFromPackageRequest($date,$shop);
        $packageId= $this->getPackageId($packageRequest);
        return ($packageId == 4)?true:false;

    }
    public function getCheckLatestPackageIsBasic($date,$shop){


        $packageRequest=$this->getLatestPackageFromPackageRequest($date,$shop);
        $packageId= $this->getPackageId($packageRequest);
        return ($packageId == 3)?true:false;

    }
    public function getMerchantPackage($date,$shop)
    {
        $date=$date['end'];

        $packageRequest=$this->getLatestPackageFromPackageRequest($date,$shop);
        return $packageRequest?$packageRequest->package->name:'N/A';

    }
    private function getPackageId($packageRequest){
        return !empty($packageRequest->package_id)?$packageRequest->package_id:null;
    }

    public function getCheckIfDateInFreeCycle($date, $shop)
    {
        $firstTimePublishedDate=$this->generalStatusRepository->getShopPublishedFirstTimeDate($shop->id);
        if(!$firstTimePublishedDate) return false;
        else {
            $range=$this->getEnd($firstTimePublishedDate->year,$firstTimePublishedDate->month,'15');
            $lastDayOfTheMonth=lastDayOfTheMonth($firstTimePublishedDate->year,$firstTimePublishedDate->month);
            $freeCycleDate= ($firstTimePublishedDate->toDateTimeString()<= $range)?
                            $range:
                            $this->getEnd($firstTimePublishedDate->year,$firstTimePublishedDate->month,$lastDayOfTheMonth);
            return $decision= ($date<=$freeCycleDate)?true:false;
        }

    }
}