<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 10/18/2015
 * Time: 5:11 PM
 */

namespace Chorki\Orders\Models;


use Carbon\Carbon;
use Chorki\Facebook\repository\FacebookShopRepository;
use Chorki\Facebook\repository\FbShopLogRepository;
use Chorki\GeneralStatusRepository;
use Chorki\packages\PackageRequestRepository;
use Chorki\Payment\Models\PaymentMethodRepository;
use Chorki\Repositories\BaseRevenueRepository;
use Chorki\Shippings\OwnShippingChannels\Models\OwnShippingChannelRepository;
use Chorki\Shippings\ShippingChannelRepository;
use Chorki\shops\Models\ShopRepositoryInterface;
use Chorki\Traits\Revenues\OwnChannelTrait;
use Chorki\Traits\Revenues\RevenueDueTrait;
use Chorki\Traits\Revenues\ServiceChargeTrait;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class RevenueRepository extends BaseRevenueRepository{
    use OwnChannelTrait;
    use RevenueDueTrait;
    use ServiceChargeTrait;
    protected $order, $range= 15, $year,$month, $orderDb, $shop, $packageRequest, $packageRequestRepository,
    $ownShippingChannelRepository,$statusRepository, $fbShopLogRepository,$totalServiceCost,
    $shippingChannelRepository,$paymentMethodRepository,$journalsRepository;

    function __construct(OrderRepositoryInterface $order,Order $orderDb,ShopRepositoryInterface $shop,
                         \PackageRequest $packageRequest,PackageRequestRepository $packageRequestRepository,
                        OwnShippingChannelRepository $ownShippingChannelRepository,
                         GeneralStatusRepository $statusRepository,FbShopLogRepository $fbShopLogRepository,
                         ShippingChannelRepository $shippingChannelRepository,
                          PaymentMethodRepository $paymentMethodRepository,JournalsRepository $journalsRepository){

        $this->order = $order;
        $this->orderDb = $orderDb;
        $this->shop = $shop;
        $this->packageRequest = $packageRequest;
        $this->packageRequestRepository = $packageRequestRepository;
        $this->ownShippingChannelRepository = $ownShippingChannelRepository;
        $this->statusRepository = $statusRepository;
        $this->fbShopLogRepository = $fbShopLogRepository;
        $this->shippingChannelRepository = $shippingChannelRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->journalsRepository = $journalsRepository;
    }

    public function getRevenues(array $date,$shopId=null){
        $shopId=$this->getShopId($shopId);
     return $revenues=  DB::table('orders')
            ->select('shop_id',
                              DB::raw('SUM(Round(commission,2)) as totalCommission'),
                              DB::raw('SUM(Round(ghooriReceived,2)) as totalCommissionReceived'),
                              DB::raw('SUM(Round(merchantReceived,2)) as totalMerchantReceived'),
                              DB::raw('SUM(Round(subtotal,2)) as totalSales'),
                              DB::raw("(SUM(subtotal)-SUM(commission))
                              as totalReceivable"),
                              DB::raw('COUNT(id) as numberOfOrder'))
            ->where('shop_id',$shopId)
            ->where('status','Complete')
            ->whereBetween('completed_at', array($date['start'], $date['end']))
            ->get();

    }


    public function getTotalReceivable(array $date,$shopId=null){
        $shopId=$this->getShopId($shopId);
              $receivable=
            $this->orderDb
            ->select(DB::raw("(SUM(subtotal)-SUM(commission)) as totalReceivable"))
            ->ordercompletedbyshop($shopId)
            ->whereNotNull('shippingPackage_id')// except own order
            ->whereBetween('completed_at', array($date['start'], $date['end']))
            ->first();
        return !empty($receivable)? $receivable->totalReceivable : 0 ;

    }
    public function getTotalReceivableByOwnChannelWhileUsingCard(array $date,$shopId=null){
        $shopId=$this->getShopId($shopId);
        $receivableUsingCard=
                 $this->orderDb
                ->select(DB::raw("(SUM(subtotal)-SUM(commission)) as totalReceivable"))
                ->ordercompletedbyshop($shopId)
                ->whereNull('shippingPackage_id')
                ->where('paymentMethod_id',2) //using card || if cod receivable 0
                ->whereBetween('completed_at', array($date['start'], $date['end']))
                ->first();

        return !empty($receivableUsingCard)? $receivableUsingCard->totalReceivable : 0 ;
    }
    public function getTotalSubscriptionFee(array $date,$shopId=null){
        $journal=$this->getJournal($date,$shopId);

        $date=$date['end'];
        $subscriptionFee=0;
        $shopId=$this->getShopId($shopId);
        $shop=$this->shop->getById($shopId);
        $inFirstCycle=$this->packageRequestRepository->getCheckIfDateInFreeCycle($date,$shop);
        $subscriptionFee=(!$inFirstCycle)?
        $this->packageRequestRepository->getTotalSubscriptionFeeFromPackageRequest($date,$shop):0;

        $subscriptionFee=$subscriptionFee?$subscriptionFee:0;
        return $this->getAmountDependsOnJournalExistence($subscriptionFee,$journal,'subscription_fee');
    }

    public function getOwnChannelFee($date,$shopId=null){
        $ownChannels=ownChannel();
        $shopId=$this->getShopId($shopId);
        $shop=$this->shop->getById($shopId);
        $ownChannelDisabledInCycleByDate=$this->ownShippingChannelRepository->getOwnChannelDisabledInCycleByDate($date,$shopId);
        $ownChannelEnabledFromStartDate=$this->ownShippingChannelRepository->getOwnChannelEnabledFromStartDate($shopId);
        $date=$this->getReturn($ownChannelEnabledFromStartDate,$date['end']);
        $ownChannelEnabledFromStartToCycleEndByDate=$this->ownShippingChannelRepository->getOwnChannelEnabledFromStartToCycleEndByDate($date,$shopId);

        $vat = Config::get('vat.rate');
        $ownChannelFeeIncludingVat= $ownChannels[1] + ($ownChannels[1]*$vat);

        $premiumPackage=$this->packageRequestRepository->getCheckLatestPackageIsPremium($date['end'],$shop);

        $journal=$this->getJournal($date,$shopId);

        if ($ownChannelEnabledFromStartToCycleEndByDate or $ownChannelDisabledInCycleByDate) {
                $ownChannelFee= (!$premiumPackage) ? $ownChannelFeeIncludingVat / 2 : 0;
            } else  $ownChannelFee=0;

        return $this->getAmountDependsOnJournalExistence($ownChannelFee,$journal,'ownChannelDelivery_fee');

    }
    public function getFacebookShopFee($date,$shopId=null){
        $facebookShopFee=facebookShopFee();
        $shopId=$this->getShopId($shopId);
        $facebookshopexists=\FacebookShop::shopHasFbShop($shopId);
        $journal=$this->getJournal($date,$shopId);

            if ($facebookshopexists) {
                $shop = $this->shop->getById($shopId);
                $facebookShopId = $shop->facebookShop->id;
                $facebookShopDisabledInCycleByDate = $this->fbShopLogRepository->getFacebookShopDisabledInCycleByDate($date, $facebookShopId);
                $facebookShopEnabledFromStartDate = $this->fbShopLogRepository->getFacebookShopEnabledFromStartDate($facebookShopId);
                $date = $this->getReturn($facebookShopEnabledFromStartDate, $date['end']);
                $facebookShopEnabledFromStartToCycleEndByDate = $this->fbShopLogRepository->getFacebookShopEnabledFromStartToCycleEndByDate($date, $facebookShopId);
                $vat = Config::get('vat.rate');
                $fbFeeIncludingVat = $facebookShopFee[1] + ($facebookShopFee[1] * $vat);
                $premiumPackage=$this->packageRequestRepository->getCheckLatestPackageIsPremium($date['end'],$shop);
                $basicPackage = $this->packageRequestRepository->getCheckLatestPackageIsBasic($date['end'],$shop);
                if($facebookShopEnabledFromStartToCycleEndByDate or $facebookShopDisabledInCycleByDate) {
                   $fbFee= ($premiumPackage or $basicPackage)?0:$fbFeeIncludingVat / 2 ;
                 }else {
                    $fbFee= 0;
                }
            }else{
                $fbFee = 0;
            }

        return $this->getAmountDependsOnJournalExistence($fbFee,$journal,'fShop_fee');

    }
    public function getCardFee($date,$shopId=null){
        $cardFee=cardFee();
        $shopId=$this->getShopId($shopId);
        $cardDisabledInCycleByDate=$this->fbShopLogRepository->getFacebookShopDisabledInCycleByDate($date,$shopId);
        $cardEnabledFromStartDate=$this->fbShopLogRepository->getFacebookShopEnabledFromStartDate($shopId);
        $date=$this->getReturn($cardEnabledFromStartDate,$date['end']);
        $cardEnabledFromStartToCycleEndByDate=$this->fbShopLogRepository->getFacebookShopEnabledFromStartToCycleEndByDate($date,$shopId);
        $vat = Config::get('vat.rate');
        $cardFeeIncludingVat= $cardFee[0] + ($cardFee[0]*$vat);
        return  ($cardEnabledFromStartToCycleEndByDate or $cardDisabledInCycleByDate)?$cardFeeIncludingVat/2:0;
    }
    public function getFilteredOrderList(array $date,$shopId=null){
        $shopId=$this->getShopId($shopId);
         $filteredOrderList= $this->orderDb
                        ->loadorders()
                        ->ordercompletedbyshop($shopId)
                        ->whereBetween('completed_at', array($date['start'], $date['end']))
                        ->select('*', DB::raw("(CASE WHEN shippingPackage_id IS NOT NULL THEN subtotal-commission
                         WHEN shippingPackage_id IS NULL && paymentMethod_id = 2
                          THEN (subtotal-commission)
                         ELSE 0 END) as totalAmount"))
                         ->get();
        $count=$filteredOrderList->count();

        return !empty($count)?$filteredOrderList:null;

    }
    public function getNetSalesDetails(array $date,$shopId=null){
        $shopId=$this->getShopId($shopId);
        $netSalesDetails= $this->orderDb
            ->loadorders()
            ->ordercompletedbyshop($shopId)
            ->whereBetween('completed_at', array($date['start'], $date['end']))
            ->select('*', DB::raw("(
                          CASE WHEN shippingPackage_id IS NOT NULL THEN ROUND(subtotal,2)-ROUND(merchantReceived,2)
                          WHEN shippingPackage_id IS NULL && paymentMethod_id = 2
                          THEN (ROUND(subtotal,2)-ROUND(merchantReceived,2))
                          ELSE 0.00 END) as netSales"),
                          DB::raw("(CASE WHEN paymentStatus = 'Paid' THEN 'Received'
                          WHEN paymentStatus = 'Received'
                          THEN 'Paid'
                          ELSE 'Pending' END) as paymentStatus"),
                          DB::raw("(CASE WHEN shippingPackage_id IS NOT NULL THEN 0.00
                          WHEN shippingPackage_id IS NULL && paymentMethod_id = 2
                          THEN Round(shippingCharge,2)
                          ELSE Round(subtotal+shippingCharge,2) END) as paymentReceivedWithOwnShippingCharge"),
                          DB::raw("(CASE WHEN shippingPackage_id IS NOT NULL THEN 0.00
                          ELSE Round(shippingCharge,2) END) as ownChannelShippingCharge"),
                          DB::raw("(CASE WHEN shippingPackage_id IS NOT NULL THEN Round(subtotal,2)
                          WHEN shippingPackage_id IS NULL && paymentMethod_id = 2
                          THEN Round(subtotal,2)
                          ELSE 0.00 END) as merchantReceivable"))
            ->get();
        $count=$netSalesDetails->count();

        return !empty($count)?$netSalesDetails:null;

    }
    public function getTransactionCharges(array $date,$shopId=null){
        $shopId=$this->getShopId($shopId);
        $transactionCharges= $this->orderDb
            ->loadorders()
            ->ordercompletedbyshop($shopId)
            ->whereBetween('completed_at', array($date['start'], $date['end']))
            ->select('*',DB::raw(" ROUND(commission,2) as txn ,
            ROUND(commission,2)-ROUND(ghooriReceived,2) as unPaid,ROUND(ghooriReceived,2) as paid"))
            ->get();
        $count=$transactionCharges->count();

        return !empty($count)?$transactionCharges:null;

    }
    public function getLifeTimeRevenueList($shopId=null){
        $shopId=$this->getShopId($shopId);
        return $filteredOrderList= $this->orderDb
            ->ordercompletedbyshop($shopId)
            ->select(DB::raw("
            CONCAT( DATE_FORMAT(completed_at, '%b %Y Day ' ),
            case when dayofmonth( completed_at ) < 16
                then '01-15'
                else CONCAT( '16-', right( last_day( completed_at ), 2)  )
                end ) as CharMonth"),
                DB::raw("
            CONCAT( DATE_FORMAT(completed_at, '%Y %c ' ),
            case when dayofmonth( completed_at ) < 16
                then 'cycle1'
                else 'cycle2'
                end ) as queryString"),
             DB::raw('SUM(commission) as totalCommission'),
             DB::raw(' (SUM(subtotal)-SUM(commission)) as totalAmount'),
             DB::raw('COUNT(id) as numberOfOrder'))
            ->groupBy('CharMonth')
            ->orderBy(DB::raw("year( 'completed_at' )"),DB::raw("month( 'completed_at' )"),
                     DB::raw("min( dayofmonth( 'completed_at' ))"))
            ->get();


    }
    public function getRootAndEndDate()
    {
        $root=null; $year=$this->getYear();$month=$this->getMonth();

        if(Input::has('type')){
            if($cycle1=Input::get('type')== 'cycle1'){

                $root=$this->getRoot($year,$month,'1');
                $end = $this->getEnd($year,$month,'15');
                return $this->getReturn($root,$end);

            }elseif($cycle2=Input::get('type')== 'cycle2'){
                $root=$this->getRoot($year,$month,'16');
                $lastDayOfTheMonth=lastDayOfTheMonth($year,$month);
                $end = $this->getEnd($year,$month,$lastDayOfTheMonth);
                return $this->getReturn($root,$end);
            }
            elseif($cycle2=Input::get('type')== 'lifetime'){
                $date=$this->getLifeTimeRevenueDate();
                $root= $date['start'];
                $end= $date['end'];
                return $this->getReturn($root,$end);
            }
        }else{
            $day=$this->range;
            $range=$this->getEnd(null,null,$day);
            $now= Carbon::now()->subHours(6)->toDateTimeString();
            if( $now <= $range ){
                $root = $this->getRoot(null,null,'1');
            }elseif($now > $range){
                $root = $this->getRoot(null,null,'16');
            }
            return $this->getReturn($root,$now);
        }
    }
    public function getPackageMigrationDate(){
        $day=$this->range;
        $range=$this->getEnd(null,null,$day);
        $now= Carbon::now()->toDateTimeString();
        $month = Carbon::now()->addMonth()->month;

        if( $now <= $range ){
            $root = $this->getRoot(null,null,'16');
        }elseif($now > $range){
            $year=$this->getPackageMigrationYear($month);
            $root = $this->getRoot($year,$month,'1');
        }
        return $this->getReturn($root,$now);
    }
    protected  function getPackageMigrationYear($month)
    {
        return $month=='1'?Carbon::now()->addYear()->year:null;
    }
    public function getLifeTimeRevenueDate(){

        $root= $this->getOrderCompletedDateByShop();
        $end= $this->getOrderCompletedDateByShop('desc');

        return $this->getReturn($root,$end);

    }
    public function getFilteredOrderListLink($slug){
        $dateRange=$this->getRootAndEndDate();
        $date= explode('-',$dateRange['end'],-1);

        if(Input::has('type')){

            $queryString=$this->getQueryString($date,$slug,Input::get('type'));

            return $link =URL::route('revenues.filteredOrderList',$queryString);
        }else{

            return $link=URL::route('revenues.filteredOrderList',[$slug]);
        }
    }
    public function getLifeTimeRevenueListLink($slug){
        return $link=URL::route('revenues.LifeTimeRevenueList',[$slug]);

    }
    public function getLifeTimeFilteredOrderListLink($slug,$lifeTimeRevenueList){
        $link=[];
        foreach($lifeTimeRevenueList as $key=>$lifeTimeRevenue){
            $string=explode(' ',$lifeTimeRevenue->queryString);
            $queryString=$this->getQueryString($string,$slug,$string[2]);
            $link[$key]=URL::route('revenues.filteredOrderList',$queryString);
        }
        return $link;
    }

    public function getNetSalesDetailsLink($slug)
    {
        $dateRange=$this->getRootAndEndDate();
        $date= explode('-',$dateRange['end'],-1);

        if(Input::has('type')){

            $queryString=$this->getQueryString($date,$slug,Input::get('type'));

            return $link =URL::route('revenues.netSalesDetails',$queryString);
        }else{

            return $link=URL::route('revenues.netSalesDetails',[$slug]);
        }
    }

    public function getMerchantPackage($date,$shop)
    {
        return $this->packageRequestRepository->getMerchantPackage($date,$shop);

    }

    public function getTransactionChargesLink($slug)
    {
        $dateRange=$this->getRootAndEndDate();
        $date= explode('-',$dateRange['end'],-1);

        if(Input::has('type')){

            $queryString=$this->getQueryString($date,$slug,Input::get('type'));

            return $link =URL::route('revenues.transactionCharges',$queryString);
        }else{

            return $link=URL::route('revenues.transactionCharges',[$slug]);
        }
    }


}