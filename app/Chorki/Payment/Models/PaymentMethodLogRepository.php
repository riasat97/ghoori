<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 12/8/2015
 * Time: 12:31 PM
 */

namespace Chorki\Payment\Models;


class PaymentMethodLogRepository {

    protected $model;

    function __construct(\PaymentMethodLog $model)
    {

        $this->model = $model;
    }
    public function postLogPaymentMethod($shop,array $paymentMethodIds){
        $shop->paymentMethodLogs()->attach($paymentMethodIds);

    }
    public function postLogDetachedPaymentMethod($shop,array $paymentMethodIds){
        $paymentMethods=$shop->paymentMethods;
        if($paymentMethods->count()){
            foreach ($paymentMethods as $paymentMethod) {
                if(!in_array($paymentMethod->id,$paymentMethodIds)){
                $shop->paymentMethodLogs()->attach([$paymentMethod->id=>['status'=>false]]);
                }
        }
        }

    }
    public function getCardEnabledFromStartToCycleEndByDate(array $date,$shopId){
        $card= $this->model
            ->where('shop_id',$shopId)
            ->where('paymentMethod_id',2)
            ->where('status',true)
            ->whereBetween('created_at', array($date['start'], $date['end']))
            ->orderBy('created_at','desc')
            ->first();
        return !empty($card)?true:false;
    }
    public function getCardDisabledInCycleByDate(array $date,$shopId){
        $card= $this->model
            ->where('status',false)
            ->where('shop_id',$shopId)
            ->where('paymentMethod_id',2)
            ->whereBetween('created_at', array($date['start'], $date['end']))
            ->first();
        return !empty($card)?true:false;
    }
    public function getCardEnabledFromStartDate($shopId){
        $startDate= $this->model
            ->where('shop_id',$shopId)
            ->where('paymentMethod_id',2)
            ->where('status',true)
            ->pluck('created_at');

        return !empty($startDate)?$startDate:null;
    }

}