<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 2/9/2016
 * Time: 2:05 PM
 */

namespace Chorki\Traits\Revenues;


use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

trait RevenueDueTrait {

   public function getDueTimeRange($date,$shopId){

       $dueTimes = [];
       $day=$this->range;
       $dateRange = Carbon::parse($date['start'])->addHours(6);
       $dateStart =$this->statusRepository->getShopPublishedFirstTimeDate($shopId);
       if(!empty($dateStart)){
           while( $dateStart<$dateRange){
               $range=Carbon::parse($this->getEnd($dateStart->year,$dateStart->month,$day))->addHours(6);
               if( $dateStart <= $range ){
                   $root = $this->getRoot($dateStart->year,$dateStart->month,'1');
                   $end = $this->getEnd($dateStart->year,$dateStart->month,'15');
                   $dt=$this->getReturn($root,$end);
               }elseif($dateStart > $range){
                   $root = $this->getRoot($dateStart->year,$dateStart->month,'16');
                   $lastDayOfTheMonth=lastDayOfTheMonth($dateStart->year,$dateStart->month);
                   $end = $this->getEnd($dateStart->year,$dateStart->month,$lastDayOfTheMonth);
                   $dt= $this->getReturn($root,$end);
               }
               $dueTimes[] = $dt;
               $dateStart = Carbon::parse($end)->addHours(6)->addSeconds(1);


           }
       }
       return $dueTimes;
   }
    public function getDueRevenue($date,$shopId=null){
        $shopId = $this->getShopId($shopId);
        $shop = $this->shop->getById($shopId);

        $due=0;
        $dueCycles=$this->getDueTimeRange($date,$shopId);
        $dueBillCycles=[];
       // dd($dueCycles);
        $count = count($dueCycles);
        if($count){
            foreach ($dueCycles as $date) {
                $revenues=$this->getRevenues($date,$shopId); //merchant payable/total transition fee/tax/Ghoori revenue||
                $totalOwnShippingCharge=$this->getOwnChannelOrderCharges($date,$shopId,false);
                $totalMerChantRevenue= $this->getTotalMerChantRevenue($revenues[0]->totalSales,
                    $totalOwnShippingCharge->totalOwnChannelCharge);

                $paymentReceivedFromOwnChannel=$this->getOwnChannelOrderCharges($date,$shopId,true);
                $totalPaymentReceivedFromOwnChannel= $this->getTotalPaymentReceivedFromOwnChannel(
                    $paymentReceivedFromOwnChannel->totalPaymentReceived
                    , $totalOwnShippingCharge->totalOwnChannelCharge);
                $totalPaymentReceivedFromGhoori = $this->getTotalPaymentReceivedFromGhoori($date,$shopId);
                $totalRevenueReceived= $this->getTotalRevenueReceived($totalPaymentReceivedFromOwnChannel,
                    $totalPaymentReceivedFromGhoori);
                $netSales = $this->getNetSales($totalMerChantRevenue,$totalRevenueReceived);

                $totalGhooriCommission=$this->getTotalGhooriCommission($revenues);
                $journal = $this->getJournal($date,$shopId);

                $totalSubscriptionFee=$this->getTotalSubscriptionFee($date,$shopId);
                $ownChannelFee=$this->getOwnChannelFee($date,$shopId);
                $facebookShopFee=$this->getFacebookShopFee($date,$shopId);

                $totalServiceCost=$this->getTotalServiceCost($totalSubscriptionFee,$ownChannelFee,$facebookShopFee);

                $totalPayable= $this->getPayableToGhoori($totalServiceCost['unPaid'],
                    $totalGhooriCommission['unPaid']);
                $total = $this->getTotalIfPayableToGhoori($netSales, $totalPayable);
                $due+=$total;
                $dueBillInCycle=$this->getDueBill($netSales,$totalPayable,$date);
                $dueBillInCycle?$dueBillCycles[]=['dateRange'=>$this->getCarbonInstance($date),
                'link'=>$this->getDueCycleLinkByDate($date,$shop->slug),
                'due'=>abs(number_format($dueBillInCycle,2))]:null;
            }
         //  dd($dueBillCycles);

            return ['due'=>round($due,2),'dueBillCycles'=>$dueBillCycles];

        }
        return ['due'=>round($due,2),'dueBillCycles'=>$dueBillCycles];
    }
    public function getTotalIfPayableToGhoori($netSales, $totalPayable){
        //dd("ok");
        $total = $netSales - $totalPayable;
        return $total<0?abs($total):0;
    }
    public function getPayableToGhoori($totalServiceCost, $totalGhooriCommission)
    {
        return $totalServiceCost+$totalGhooriCommission ;
    }
    public function getDueBill($netSales,$totalPayable,$date){
        $total = $netSales - $totalPayable;
        if($total<0){
           return round($total,2);
        }

    }
    public function getDueCycleLinkByDate($date,$slug){
        $cycle=$this->getCycleByDate($date['end']);
        $date=$this->getSplitDate($date['end']);
        $queryString=$this->getQueryString($date,$slug,$cycle);
        return URL::route('revenue.index',$queryString);

    }

}