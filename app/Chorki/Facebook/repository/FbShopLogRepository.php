<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 11/22/2015
 * Time: 5:04 PM
 */

namespace Chorki\Facebook\repository;


class FbShopLogRepository {

    protected $fbShopLog;

    function __construct(\FbShopLog $fbShopLog)
    {
        $this->model = $fbShopLog;
    }
    public function postLogFbShop($fbShop){
        $this->model->status = true;
        $fbShop->fbShopLogs()->save($this->model);

    }
    public function getFacebookShopEnabledFromStartToCycleEndByDate(array $date,$facebookShopId){
        $facebookShop= $this->model
            ->where('facebookShop_id',$facebookShopId)
            ->where('status',true)
            ->whereBetween('created_at', array($date['start'], $date['end']))
            ->orderBy('created_at','desc')
            ->first();
        return !empty($facebookShop)?true:false;
    }
    public function getFacebookShopDisabledInCycleByDate(array $date,$facebookShopId){
        $facebookShop= $this->model
            ->where('status',false)
            ->where('facebookShop_id',$facebookShopId)
            ->whereBetween('created_at', array($date['start'], $date['end']))
            ->first();
        return !empty($facebookShop)?true:false;
    }
    public function getFacebookShopEnabledFromStartDate($facebookShopId){
        $startDate= $this->model
            ->where('facebookShop_id',$facebookShopId)
            ->where('status',true)
            ->pluck('created_at');

        return !empty($startDate)?$startDate:null;
    }

}