<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 8/3/2015
 * Time: 11:26 AM
 */

namespace Chorki\Shippings\OwnShippingChannels\Models;

use Carbon\Carbon;
use Chorki\Repositories\DbRepositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class OwnShippingChannelRepository extends DbRepositories  {

    private $model;

    public function __construct(OwnShippingChannel $model){

        $this->model = $model;
    }


  /*  public function getOwnChannelFeeFromOwnShippingChannel($date,$shop){
        $ownChannels=ownChannel();
        $ownChannel=$this->model
            ->where('shop_id',$shop)
            ->where('status','accepted')
            ->whereNotNull('accepted_at')
            ->where('accepted_at','<=',$date)
           // ->whereBetween(DB::raw('DATE(created_at)'), array($date['start'], $date['end']))
            ->first();
        return $ownChannel?$ownChannels[$ownChannel->ownChannel]/2:0;
    }*/
    public function update($shop){

        $ownChannel=$this->getOwnChannel();

        if($ownChannel != $shop->ownChannel){
            $shop->ownChannel= $ownChannel;
            $shop->ownChannel_at=Carbon::now()->toDateTimeString();
            $shop->update();
            $this->model->ownChannel=$shop->ownChannel;
            $shop->ownShippingChannels()->save($this->model);
        }
    }

    public function getOwnChannelEnabledFromStartToCycleEndByDate(array $date,$shopId){
         $ownChannel= $this->model
            ->where('shop_id',$shopId)
            ->whereBetween('created_at', array($date['start'], $date['end']))
            ->orderBy('created_at','desc')
            ->first();
        return !empty($ownChannel->ownChannel)?true:false;
    }
    public function getOwnChannelDisabledInCycleByDate(array $date,$shopId){
         $ownChannel= $this->model
            ->where('ownChannel',0)
            ->where('shop_id',$shopId)
            ->whereBetween('created_at', array($date['start'], $date['end']))
            ->first();
         return !empty($ownChannel)?true:false;
    }
    public function getOwnChannelEnabledFromStartDate($shopId){
        $startDate= $this->model
            ->where('shop_id',$shopId)
            ->where('ownChannel',1)
            ->pluck('created_at');

        return !empty($startDate)?$startDate:null;
    }

    private function getOwnChannel()
    {
       return Input::get('ownChannel')?Input::get('ownChannel'):false;
    }
}