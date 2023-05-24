<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 11/17/2015
 * Time: 11:55 AM
 */

namespace Chorki\Orders\Models;


use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class MyOrderRepository extends OrderRepository{


    public function resentSMSOrderMobileVerificationCode(){

        $orderId=Input::get('orderId');
        $order=$this->getById($orderId);
        $order->load('shippingAddress');
        $shippingAddress=$order->shippingAddress;

        $verificationCode=$shippingAddress->code;
        $count=$verificationCode->resendCount;

        if($count <= 2){
            $resendCount=$count+1;
            $verificationCode->resendCount=$resendCount;
            $verificationCode->update();
            $code = $verificationCode->code;
            $message = "Your Mobile Activation code is $code. Use this code to verify your order .";
            $this->sentSmsOrderVerificationCode($shippingAddress,$message);
            return true;
        }
        else return false;

    }
    public function getCheckUrlTimeWithInRange($order){
     $now=Carbon::now();
     $created_at=$order->created_at;
     $diffInHours=$created_at->diffInHours($now);
        return ($diffInHours<=6)?true:false;
    }
    public function getUnverifiedOrdersLink($myOrders){
        $unVerifiedOrdersLink=[];
        foreach ($myOrders as $order) {
            $valid=$this->getCheckUrlTimeWithInRange($order);
            if($order->status == 'Unverified' && $valid){
                $unVerifiedOrdersLink[$order->id]=URL::route('orders.verify',[$order->id]);
            }
            else{
                $unVerifiedOrdersLink[$order->id]=false;
            }
        }
        return $unVerifiedOrdersLink;

    }


}