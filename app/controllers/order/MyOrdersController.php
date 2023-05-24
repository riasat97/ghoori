<?php

use Chorki\Validators\Order\OrderRejectionReasonValidator;

class MyOrdersController extends \OrdersController {

    public function getMyOrders(){
        $myOrders=$this->order->getOrderByUser();
        $myOrders=$this->LazyLoadOrders($myOrders);
        $acceptedEcourierStatus=AcceptedEcourierStatusToRejectParcelByCustomer();
        $unVerifiedOrdersLink=$this->myOrderRepository->getUnverifiedOrdersLink($myOrders);
        $reasons=RejectionReason::joinrejectiontype()->duringplacement()
                ->get();
        return View::make('orders.myorders.history',compact('myOrders','acceptedEcourierStatus','unVerifiedOrdersLink','reasons'));

    }

    public function getMyOrderReject(){
        $order = $this->order->getById(Input::get('orderId'));
        if($order->status == 'New' or $order->status='Unverified'){
            $reasons=RejectionReason::joinrejectiontype()->duringplacement()
                ->get();
        }
        elseif($order->status == 'Proceed'){
            $reasons= RejectionReason::joinrejectiontype()->duringdelivery()
                ->get();
        }

        return View::make('orders.myorders.rejectForm',compact('order','reasons'));
    }
    public function postMyOrderReject(){

        $validator= OrderRejectionReasonValidator::make(Input::all());
        if($validator->fails()){
            return Redirect::route('orders.myOrder')
                ->withInput()
                ->withErrors($validator->instance());
        }
        else
        {
            $order = $this->order->getById(Input::get('order_id'));
            $this->postMyOrderRejectionReason($order);

            $shippingChannel=$this->getShippingChannel($order);
            $acceptedEcourierStatus=AcceptedEcourierStatusToRejectParcelByCustomer();
            $orderParcelStatus= explode('@',$order->parcelStatus,-1);

            if($order->status === 'Proceed' && $shippingChannel ==='ecourier' && !empty($orderParcelStatus[0]) && in_array($orderParcelStatus[0],$acceptedEcourierStatus,true)){
                $response=$this->order->postParcelCancel($order->parcelId,$order->shop_id);
                //  dd($response);
            }

            $this->restoreProduct($order);
            $order->status = 'Reject';
            $order->update();
            $this->LazyLoadOrders($order);
            $order['shippingChannel']=$this->getShippingChannel($order);

            $this->sendSMSToCustomer($order,$this->getMessageForOrderRejectionByCustomer($order));
            $this->sendSMSToMerchant($order, "Order no. ".($order->id + 100000)."has been rejected by customer..visit your eshop for more details");

            $this->sentEmailToCustomer($order,'emails.invoice',"Your Order no. ".($order->id + 100000)." form ".$order->shop->title." is now Rejected.", "Order Details");

            $msg = "Order no. ".($order->id + 100000)." form Your eshop ".$order->shop->title." is  Rejected by Customer";
            $subject = "Order no. ".($order->id + 100000). "has been rejected";
            $this->sentEmailToMerchant($order,'emails.merchant.orderRejected',$msg, $subject);

            return Redirect::route('orders.myOrder')->with('flash_message', '<b>Order Canceled</b>')
                ->with('flash_type', 'alert-success');

        }


    }


    private function postMyOrderRejectionReason($order)
    {
        OrderRejectionReason::create([
                'order_id'=>$order->id,
                'rejectionreason_id'=>Input::get('rejectionreason_id'),
                'reason'=>Input::get('reason'),
            ]
        );

    }

    public function getOrderMobileVerificationCodeView($orderId){

     $order=$this->order->getById($orderId);
     $order->load('shippingAddress');
     $shippingAddress=$order->shippingAddress;
     $valid=$this->myOrderRepository->getCheckUrlTimeWithInRange($order);
     return $valid? View::make('verificationCode.orderCode',compact('order','shippingAddress')):
            View::make('errors.404');

    }
    public function postOrderMobileVerificationCode($orderId){
        $order=$this->order->getById($orderId);
        $order->load('shippingAddress');
        $verificationCode=$order->shippingAddress->code;
        $userCode=Input::get('code');
        if($verificationCode->code == $userCode)
        {
            $order->status='New';
            $order->update();
            $this->order->postGeneralOrderStatus($order);
            $orderInfo = $this->getOrderInfo($order);
            $this->emailAndSMSAfterOrderPlacing($orderInfo);
            return Redirect::route('carts.index')->with('flash_message', '<b>Order successfully placed and
                   verified</b>')
                ->with('flash_type', 'alert-success')
                ->with('order',$orderInfo);
        }
        else
        {
            $attemptNo= $verificationCode->attempt;
            if($attemptNo<2) {
                $countAttempt = $attemptNo + 1;
                $verificationCode->attempt=$countAttempt;
                $verificationCode->update();
                $attempt= $verificationCode->attempt;
                return Redirect::route('orders.verify',$order->id)->with('attempt', $attempt);
            }
            else{
                return Redirect::route('orders.verify',$order->id)->with('message', 'You do not have any attempt left.
                                       Call center number: 09612000888. Contact there to verify');

            }
        }
    }
  public function resendOrderMobileVerificationCodeToUser(){
       $orderId=Input::get('orderId');
       $sent= $this->myOrderRepository->resentSMSOrderMobileVerificationCode();
      return $sent? Redirect::route('orders.verify',$orderId)
            ->with('flash_message','Mobile verification code  resend Successful..Check inbox')
            ->with('flash_type', 'alert-success'):Redirect::route('orders.verify',$orderId);

  }
    public function parcelInquiry($parcelId){
        $parcelStatus=$this->courier->parcelInquiry($parcelId);
        $status=$parcelStatus[0]->status;
        function maxValueInArray($array, $keyToSearch)
        {
            $currentMax = NULL;
            foreach($array as $arr)
            {
                foreach($arr as $key => $value)
                {
                    if ($key == $keyToSearch && ($value >= $currentMax))
                    {
                        $currentMax = $value;
                        $status =  $arr[0];

                    }
                }
            }

            return ['time'=>$currentMax ,'status'=>$status];
        }

//                                            array       key
        $value = maxValueInArray($status, "2");
        dd($value);
    }

}