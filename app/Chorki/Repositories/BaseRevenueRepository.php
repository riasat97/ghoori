<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 10/21/2015
 * Time: 12:00 PM
 */

namespace Chorki\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

abstract class BaseRevenueRepository {

    public function getYear()
    {
        return $this->year = Input::has('year') ?  Input::get('year') : null;
    }


    public function getMonth()
    {
        return $this->month = Input::has('month') ?  Input::get('month') : null;
    }

    protected function getRoot($year,$month,$day)
    {
        return $root = Carbon::createFromDate($year,$month,$day)->startOfDay()->subHours(6)->toDateTimeString();
    }

    protected function getEnd($year,$month,$day)
    {
        return $end = Carbon::createFromDate($year,$month,$day)->endOfDay()->subHours(6)->toDateTimeString();
    }

    protected function getReturn($root,$end)
    {
        return ['start'=>$root,'end'=>$end];
    }
    public function getShopId($shopId=null){

        return is_null($shopId)? $this->shop->_getShop()->id:$shopId;
    }
    public function getCarbonInstance(array $dateTime){
     //  dd(Carbon::parse($dateTime['start']));
        $root= $dateTime['start']?Carbon::createFromFormat('Y-m-d H:i:s',$dateTime['start']):null;
        $end= $dateTime['end']?Carbon::createFromFormat('Y-m-d H:i:s',$dateTime['end']):null;

        return $this->getReturn($root,$end);
    }
    public function getCarbonParseObject($date){
        return Carbon::parse($date);
    }
    public function getOrderYearRange($shopId=null){
      //  dd($shopId);
        $from=is_null($shopId)?$this->getOrderCompletedDate():$this->getOrderCompletedDateByShop('ASC',$shopId);

        $from= $from?explode('-',$from,-2):null;

        $to= is_null($shopId)?$this->getOrderCompletedDate('DESC'):$this->getOrderCompletedDateByShop('DESC',$shopId);
        $to= $to?explode('-',$to,-2):null;

        return $this->getReturn($from,$to);

    }
    protected function getOrderCompletedDateByShop($sort='ASC',$shopId=null)
    {

        $shopId=$this->getShopId($shopId);
        $date = $this->orderDb
            ->ordercompletedbyshop($shopId)
            ->orderBy('completed_at',$sort)
            ->first(['completed_at']);

        return $date?$date->completed_at:null;

    }
    protected function getOrderCompletedDate($sort='ASC')
    {
        $date = $this->orderDb
            ->where('status','Complete')
            ->orderBy('completed_at',$sort)
            ->first(['completed_at']);

        return $date?$date->completed_at:null;

    }
    protected function getQueryString(array $string,$slug,$type)
    {
        return [$slug,'month'=>$string[1],'year'=>$string[0],'type'=>$type];
    }
    public function getTotalServiceCost($totalSubscriptionFee, $ownChannelFee, $facebookShopFee)
    {

         $paid=($totalSubscriptionFee['paid']+ $ownChannelFee['paid']+ $facebookShopFee['paid']);
         $unPaid=($totalSubscriptionFee['unPaid']+ $ownChannelFee['unPaid']+ $facebookShopFee['unPaid']);
         return ['unPaid'=>$unPaid,'paid'=>$paid];

    }
    public function getTotalPayableToGhoori($totalServiceCost, $totalGhooriCommission,$previousDue)
    {
        return $totalServiceCost+$totalGhooriCommission + $previousDue;
    }
    public function getTotalSales($revenues)
    {
        return $revenues[0]->totalSales?$revenues[0]->totalSales:0;
    }
    public function getTotalGhooriCommission($revenues){

        $totalCommission= $revenues[0]->totalCommission?round($revenues[0]->totalCommission,2):0.00;
        $totalCommissionReceived=$revenues[0]->totalCommissionReceived?
        round($revenues[0]->totalCommissionReceived,2):0.00;
        $unPaid = $totalCommission - $totalCommissionReceived;
        return ['paid'=>$totalCommissionReceived,'unPaid'=>$unPaid,'totalCommission'=>$totalCommission];
    }
    public function getNetSales($totalMerChantRevenue, $totalRevenueReceived)
    {
         $netSales=$totalMerChantRevenue - $totalRevenueReceived ;
        return $netSales;

    }

    public function getTotalMerChantRevenue($netSales, $totalOwnShippingCharge)
    {
        $netSales= $netSales?$netSales:0.00;
        $totalOwnShippingCharge =$totalOwnShippingCharge?$totalOwnShippingCharge:0.00;
        return $netSales+$totalOwnShippingCharge;
    }
    public function getTotalPaymentReceivedFromOwnChannel($totalPaymentReceived, $totalOwnChannelCharge){
        $totalPaymentReceived= $totalPaymentReceived?$totalPaymentReceived:0.00;
        $totalOwnChannelCharge =$totalOwnChannelCharge?$totalOwnChannelCharge:0.00;
        return $totalPaymentReceived+$totalOwnChannelCharge;
    }
    public function getTotalPaymentReceivedFromGhoori($date,$shopId=null)
    {
        $shopId=$this->getShopId($shopId);
        $received=
            $this->orderDb
            ->select(DB::raw("(SUM(CASE WHEN shippingPackage_id IS NOT NULL THEN ROUND(merchantReceived,2)
                                  WHEN shippingPackage_id IS NULL && paymentMethod_id =2 THEN ROUND(merchantReceived,2)
                                  ELSE 0 END)) as totalReceived"))
                ->ordercompletedbyshop($shopId)
                ->whereBetween('completed_at', array($date['start'], $date['end']))
                ->first();

        return !empty($received->totalReceived)? $received->totalReceived : 0 ;

    }
    public function getTotalRevenueReceived($totalPaymentReceivedFromOwnChannel, $totalPaymentReceivedFromGhoori)
    {
        return $totalPaymentReceivedFromOwnChannel+$totalPaymentReceivedFromGhoori;
    }
    public function getTotal($netSales, $totalPayable)
    {
        $total = $netSales - $totalPayable;

        if($total>=0){
            $status = 'Receivable Amount from Ghoori';
        }
        else{
            $status = 'Final Payable Amount to Ghoori';
        }

        return ['total'=>abs($total),'finalStatus'=>$status];

    }
    public function getGrandTotal($revenues, $grandReceivable, $totalSubscriptionFee, $ownChannelFee,
                                  $facebookShopFee,$cardFee)
    {
        $totalPayable= $revenues[0]->totalCommission?$revenues[0]->totalCommission:0;
        $grandTotal=($grandReceivable - $totalPayable -
        $totalSubscriptionFee - $ownChannelFee - $facebookShopFee - $cardFee);

        return number_format($grandTotal,2);
    }
    protected function getADateOfTheLastMonthByDay($day)
    {
        $year=Carbon::now()->subMonth()->year;
        $month=Carbon::now()->subMonth()->month;
        return $date=Carbon::createFromDate($year,$month,$day)->startOfDay()->subHours(6)->toDateTimeString();


    }
    protected function getSelectedShopIds($toArray, $toArray1)
    {
        $shops=array_merge($toArray,$toArray1);
        $shopIds=[];
        foreach($shops as $key=>$shop){

            $shopIds[$key]=$shop['shop_id'];;
        }

        return $shopIds=array_unique($shopIds);

    }
    protected function getSelectedShopsToSentInvoice($date)
    {
        $firstShopPublishedFromStartDate=$this->statusRepository->getShopPublishedFromStartDate();
        $firstShopPublishedFromStartToCycleEndDate=$this->getReturn($firstShopPublishedFromStartDate,$date['end']);
        $shopIdsPublishedFromStartToCycleEnd= $this->statusRepository->getPublishedShopByDate($firstShopPublishedFromStartToCycleEndDate);
        $shopIdsUnpublishedInCycle=$this->statusRepository->getUnPublishedShopInCycleByDate($date);
        $shopIds=$this->getSelectedShopIds($shopIdsPublishedFromStartToCycleEnd->toArray(),$shopIdsUnpublishedInCycle->toArray());
        return $shopIds;
    }
    public function getCurrentYear(){
        $year=Carbon::now()->year;
        return $year;
    }
    public function getYears($shopId=null)
    {
        $yearRange=$this->getOrderYearRange($shopId);
        $currentYear = [$this->getCurrentYear() => $this->getCurrentYear()];
        return  $year=$yearRange['start']?array_combine(range($yearRange['start'][0], $yearRange['end'][0]),
            range($yearRange['start'][0],$yearRange['end'][0])):$currentYear;
    }
    public function getJournal(array $date,$shopId=null){
       $shopId=$this->getShopId($shopId);
       $this->setJournalTimeCycle($date);
       return $this->journalsRepository->getJournalAccordingToCycle($shopId);
    }
    public function setJournalTimeCycle(array $date){
        $cycle=$this->getCycleByDate($date['end']);
        $dateFormat = $this->getSplitDate($date['end']);
        $date=['year'=>$dateFormat[0],'month'=>$dateFormat[1],'cycle'=>$cycle];

        return $this->journalsRepository->setTimeCycle($date);
    }

    public function getCycleByDate($date){
        $dateFormat = $this->getSplitDate($date);
        $day=$this->range;
        $range=$this->getEnd($dateFormat[0],$dateFormat[1],$day);
        if( $date <= $range ){
            return 'cycle1';
        }elseif($date > $range){
            return 'cycle2';
        }

    }
    public function getSplitDate($date){
        return   $dateFormat = explode('-',$date,-1);
    }

}