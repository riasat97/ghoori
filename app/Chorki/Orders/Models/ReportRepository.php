<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 11/24/2015
 * Time: 3:14 PM
 */

namespace Chorki\Orders\Models;


use Chorki\Traits\reports\ReportTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class ReportRepository extends RevenueRepository{
    use ReportTrait;
    public function getReportView(){
        $year=$this->getYears();
        $shippingChannel=$this->shippingChannelRepository->getShippingChannelList();
        $paymentMethodList = $this->paymentMethodRepository->getPaymentMethodList();
        return View::make('reports.report',compact('year','shippingChannel',
            'paymentMethodList'));
    }
    public function getReports(){
        $packageIds=$this->getCourierPackages();
        $courier=Input::get('courier');
        $paymentMethod=Input::get('paymentMethod');
        $type=Input::get('type');
        $date=$this->getRootAndEndDate();
        $year=$this->getYears();
        $shippingChannel=$this->shippingChannelRepository->getShippingChannelList();
        $paymentMethodList = $this->paymentMethodRepository->getPaymentMethodList();

        if($courier == 1 && $paymentMethod == 1){

            $reports=$this->getEcourierReportWithCodGroupByShop($packageIds,$paymentMethod,$date);
            $total = $this->getEcourierReportWithCodGroupByShop($packageIds,$paymentMethod,$date,null,false);

            $reportDetailsLink=$this->getReportDetailsLink($reports,$date,$courier,$paymentMethod,$type);

            $date=$this->getCarbonInstance($date);

            Input::flash();
            return View::make('reports.ecourier',compact('reports','total','date','year','shippingChannel',
                'paymentMethodList','reportDetailsLink'));
        }

    }
    public function getReportDetails(){
      $packageIds=$this->getCourierPackages();
      $courier=Input::get('courier');
      $paymentMethod=Input::get('paymentMethod');
      $shopId=Input::get('shopId');
      $date=$this->getRootAndEndDate();
      $year=$this->getYears($shopId);
      $shippingChannel=$this->shippingChannelRepository->getShippingChannelList();
      $paymentMethodList = $this->paymentMethodRepository->getPaymentMethodList();
      $selectedShopList= $this->getSelectedShopListForReportDetails($date,$packageIds,$paymentMethod);
      if($courier == 1 && $paymentMethod == 1){

          $reports=$this->getEcourierReportWithCodByShop($packageIds,$paymentMethod,$shopId,$date);
          $total = $this->getEcourierReportWithCodGroupByShop($packageIds,$paymentMethod,$date,$shopId,false);
          $shopId= $this->getProcessDataReports($reports,$shopId);

          $date=$this->getCarbonInstance($date);

          Input::flash();
          return View::make('reports.ecourierDetails',compact('reports','total','date','year','shippingChannel',
                 'paymentMethodList','shopId','selectedShopList'));
      }
    }


    protected function getEcourierReportWithCodByShop($packageIds,$paymentMethod,$shopId,$date)
    {
       return $this->orderDb
        ->with('shop','shippingPackage','paymentMethod')
        ->whereIn('shippingPackage_id',$packageIds)
        ->where('paymentMethod_id',$paymentMethod)
        ->whereIn('shop_id',$shopId)
        ->where('status','Complete')
        ->whereBetween('completed_at', array($date['start'], $date['end']))
        ->select('*',DB::raw(" ((subtotal*1)/100)+ shippingCharge as ecourierRevenue, commission-((subtotal*1)/100)
          as ghooriRevenue , subtotal-commission as merchantRevenue"))
        ->orderBy('shop_id')
        ->get();
    }



    private function getEcourierReportWithCodGroupByShop($packageIds, $paymentMethod, $date,$shopId=null,$groupBy=true)
    {
        return $this->orderDb
            ->associateshop($shopId)
            ->groupbyshop($groupBy)
            ->with('shop','shippingPackage','paymentMethod')
            ->whereIn('shippingPackage_id',$packageIds)
            ->where('paymentMethod_id',$paymentMethod)
            ->where('status','Complete')
            ->whereBetween('completed_at', array($date['start'], $date['end']))
            ->select('*',DB::raw(" sum(subtotal) as subTotal,sum(shippingCharge) as shippingFee,sum(total)
              as grandTotal
             ,sum((subtotal*codCharge)/100)+ sum(shippingCharge) as ecourierRevenue,
             sum(commission)-sum((subtotal*codCharge)/100)as ghooriRevenue ,
             sum(subtotal)-sum(commission) as merchantRevenue"))
            ->get();
    }



    private function getSelectedShopListForReportDetails($date, $packageIds, $paymentMethod)
    {
        $shopList=  $this->orderDb
            ->join('shops','orders.shop_id','=','shops.id')
            ->whereIn('orders.shippingPackage_id',$packageIds)
            ->where('orders.paymentMethod_id',$paymentMethod)
            ->where('orders.status','Complete')
            ->whereBetween('orders.completed_at', array($date['start'], $date['end']))
            ->get(['shops.id','shops.title']);

        return $shopList->lists('title','id');
    }


}