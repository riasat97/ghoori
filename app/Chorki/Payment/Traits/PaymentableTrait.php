<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 1/17/16
 * Time: 7:03 PM
 */

namespace Chorki\Payment\Traits;

use Chorki\Payment\Models\Payment;

use Exception;

trait PaymentableTrait {

    private $no_payment_msg = 'Payment has not been set. Invoke setPayment method on the instance to set payment.';

    public function payment()
    {
        return $this->morphOne('Chorki\Payment\Models\Payment','paymentable');
    }

    /**
     * @param double $requested_amount
     * @return bool
     */
    public function setPayment($requested_amount)//@todo should be in the payment model
    {
        if($this->payment){
            if($requested_amount>0.009){
                $this->payment->requested_amount = $requested_amount;
                return $this->payment->save();
            }
            return false;
        }
        $payment = new Payment();
        $payment->requested_amount = $requested_amount;
        if(!$payment->save()){
            return false;
        }
        return $this->payment()->save($payment);
    }

    public function getPaymentDetails()
    {
        if($this->payment()->get()->isEmpty()){
            throw new Exception($this->no_payment_msg);
        }
        return $this->payment()->get()->first()->getDetails();
    }

    public function getPaymentUrl($payment_method)
    {
        if($this->payment()->get()->isEmpty()){//@todo do it in a nicer way
            return '';//it was changed for accommodating boost product payment
            //throw new Exception($this->no_payment_msg);
        }
        return $this->payment()->get()->first()->getPaymentURL($payment_method);
    }

}