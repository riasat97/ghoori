<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 10/25/2015
 * Time: 5:08 PM
 */

namespace Chorki\Orders\Models;

use Carbon\Carbon;
use Log as Log;

class GeneralOrderRepository extends OrderRepository{

    public function postUpdateParcelStatus(){

       $filteredOrders= $this->model->where('status','Proceed')->whereNotNull('parcelId')->get();
        foreach($filteredOrders as $key=>$order){
            $parcelStatus=$this->getParcelInquiry($order->parcelId,$order->shop_id);
            if($parcelStatus != null) {
                // Log::info('Ecourier parcel status', ['parcelStatus' => $parcelStatus]);
                $status=$parcelStatus[0]->status;
                // Log::info('Ecourier parcel actual status', ['status' => $status]);
                $latestStatus=$this->getLatestStatusByTimeIndex($status,'2');
                // Log::info('Ecourier parcel latest status', ['lateststatus' => $latestStatus]);
            }
            else {
                $latestStatus = array('status'=>'n/a', 'time' => 'n/a');
            }
            
            $this->postLatestStatus($order,$latestStatus);
        }
        return true;
    }
    public function postRevertStockForTemporaryOrders(){
        $now=Carbon::now();
        $filteredOrders= $this->model
                        ->where('status','PaymentRequested')
                        ->get();
        if($filteredOrders->count()){
        foreach ($filteredOrders as $filteredOrder) {
           $diffInHours= $filteredOrder->created_at->diffInHours($now);
            if($diffInHours>=24){
                $filteredOrder->status='PaymentTimeOut';
                $filteredOrder->update();
                $this->restoreOrderProducts($filteredOrder->id);
            }
        }
            return 'successfully reverted stocks for temporary orders which are older than 24 hours';
        }
        else{
            return 'No such orders are payment requested status';
        }

    }
}