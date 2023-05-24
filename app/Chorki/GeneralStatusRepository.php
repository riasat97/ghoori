<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 10/25/2015
 * Time: 7:07 PM
 */

namespace Chorki;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GeneralStatusRepository {

    private $generalStatus;

    function __construct(\GeneralStatus $generalStatus){

        $this->generalStatus = $generalStatus;
    }

    public function logGeneralStatus($shop)
    {
        $this->generalStatus->action=$shop->status;
        $this->generalStatus->user_id= Auth::user()->id;
        $shop->generalStatuses()->save($this->generalStatus);

    }
    public function logGeneralOrderStatus($order)
    {
        $this->generalStatus->action=$order->status;
        $this->generalStatus->shop_id= $order->shop_id;
        $this->generalStatus->user_id= Auth::user()->id;
        $order->generalStatuses()->save($this->generalStatus);

    }
    public function getPublishedShopByDate(array $date){
      return $shops= $this->generalStatus
            ->select('shop_id')
           ->from(DB::raw("( SELECT * FROM `generalstatuses` where action IN ('Published','Unpublished')
                  ORDER BY `id` desc) as `status`"))
           ->groupBy('shop_id')
           ->where('action','Published')
           ->whereBetween(DB::raw('DATE(created_at)'), array($date['start'], $date['end']))
           ->get();
       // dd($shops->toArray());
    }
    public function getUnPublishedShopInCycleByDate(array $date){
       return $shops= $this->generalStatus
            ->select('shop_id')
            ->where('action','Unpublished')
            ->whereBetween(DB::raw('DATE(created_at)'), array($date['start'], $date['end']))
            ->groupBy('shop_id')
            ->get();
        //dd($shops->toArray());
    }
    public function getShopPublishedFromStartDate(){
        $startDate= $this->generalStatus
            ->where('action','Published')
            ->pluck(DB::raw('DATE(created_at)'));
        return!empty($startDate)?$startDate:null;
    }
    public function getShopPublishedFirstTimeDate($shopId){
        $startDate= $this->generalStatus
            ->where('action','Reviewed')
            ->where('shop_id',$shopId)
            ->pluck('created_at');
        return!empty($startDate)?$startDate:null;
    }
}