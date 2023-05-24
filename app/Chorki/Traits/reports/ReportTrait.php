<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 12/1/2015
 * Time: 12:28 PM
 */

namespace Chorki\Traits\reports;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

trait ReportTrait {
    private function getProcessDataReports($reports,$shopId)
    {
        $count=$reports->count();
        return $count?$reports[0]->shop->id: $shopId ;
    }

    public function getReportDetailsLink($reports,$date,$courier,$paymentMethod,$type)
    {
        $reportDetailsLink=[];
        $date= explode('-',$date['end'],-1);

        foreach ($reports as $report) {
            $queryString=$this->getQueryStringForReportDetails($date[1],$date[0],$courier,$paymentMethod,
                ['shopId'=>$report->shop_id],$type);
            $reportDetailsLink[$report->shop_id]= URL::route('generateReportDetails',$queryString);
        }
        return $reportDetailsLink;


    }

    public function getQueryStringForReportDetails($month, $year, $courier, $paymentMethod,array $shopId,$type)
    {
        return ['month'=>$month,'year'=>$year,'courier'=>$courier,
            'paymentMethod'=>$paymentMethod,'shopId'=>$shopId,'type'=>$type];
    }
    public function getCourierPackages(){

        $courier=Input::get('courier');
        if($courier == 1){
            $ecourier=$this->shippingChannelRepository->getById(1);
            return $packageIds=$ecourier->shippingPackages->lists('id');
        }
    }
}