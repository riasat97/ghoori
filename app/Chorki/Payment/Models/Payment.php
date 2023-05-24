<?php

namespace Chorki\Payment\Models;

use URL;

class Payment extends \Eloquent {

	protected $fillable = ['requested_amount'];

    private static function generateUniqueToken($length=40) {
        $token = strtolower(str_random($length));
        if (static::tokenExists($token)) {
            return static::generateUniqueToken($length);
        }
        return $token;
    }

    private static function tokenExists($token){
        return static::whereToken($token)->exists();
    }

    public static function boot(){
        parent::boot();

        static::creating(function ($payment) {
            if(!$payment->validAmount()){
                return false;
            }
            $payment->token = static::generateUniqueToken();
        });

        static::saved(function ($payment) {
            if($payment->isDirty('status')){
                switch($payment['status']){
                    case 'completed':
                        if(method_exists($payment->paymentable,'onPaymentComplete')){
                            $payment->paymentable->onPaymentComplete();
                        }
                        break;
                    case 'pending':
                        if(method_exists($payment->paymentable,'onPaymentPending')){
                            $payment->paymentable->onPaymentPending();
                        }
                        break;
                }
            }
        });
    }

    public function changeStatusTo($new_status, $save_after_changing = true){
        $old_status = $this->status;
        switch($new_status){
            case 'pending':
                //if($old_status!='in_progress'){//@todo implement this later
                //    throw new \Exception("Payment status cannot be made $new_status from $old_status");
                //}
                $this->status = $new_status;
                break;
            default:
                throw new \Exception("Given status '$new_status' is not a valid status for Payment Model");
        }
        if($save_after_changing){
            $this->save();
        }
    }

    public function validAmount(){
        if($this->requested_amount<=0.001){
            return false;
        }
        return true;
    }

    public function transactions(){
        return $this->hasMany('Chorki\Payment\Models\Transaction');
    }

    public function paymentable(){
        return $this->morphTo();
    }

    public function getPaymentURL($transaction_method){
        switch($transaction_method){
            case 'bkash':
                return URL::route('make-payment',['bkash',$this->token]);
            break;
            default:
                throw new Exception("Payment method $transaction_method not found");
        }
    }

    public function getDetails(){
        $details = array_only($this->toArray(),['requested_amount','paid_amount','status']);
        $details['transactions'] = [];
        $this->transactions->each(function($transaction)use(&$details){
            $details['transactions'][] = $transaction->getTransactionDetails();
        });
        return $details;
    }

    public function updatePaidAmount(){ //@todo do it automatically using event
        $totalPaidAmount = 0.00;
        $this->transactions->each(function($transaction)use(&$totalPaidAmount){
            if($transaction->status == 'completed'){
                $totalPaidAmount = $totalPaidAmount + $transaction->amount;
            }
        });
        $this->paid_amount= $totalPaidAmount;

        $requested = (double) $this->requested_amount;
        $paid = (double) $this->paid_amount;
        if( $requested - $paid < 0.001){
            $this->status = 'completed'; //@todo utilize $this->changeStatusTo
        }else{
            $this->status = 'incomplete'; //@todo utilize $this->changeStatusTo
        }
        $this->save();

        return $totalPaidAmount;
    }

}