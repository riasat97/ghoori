<?php

namespace Chorki\Payment\Models;

class Transaction extends \Eloquent {
	protected $fillable = ['transaction_method'];

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

        static::creating(function ($transaction) {
            $transaction->token = static::generateUniqueToken();
        });
        static::saved(function ($transaction) {
            if($transaction->isDirty('status')){
                if($transaction['status']=='completed'){
                    $transaction->payment->updatePaidAmount();
                }elseif($transaction['status']=='pending_verification'){
                    $transaction->payment->changeStatusTo('pending');//@todo make it exclusive to currently active transaction only
                }
            }
        });
    }

    public function payment(){
        return $this->belongsTo('Chorki\Payment\Models\Payment');
    }

    public function transactionable(){
        return $this->morphTo();
    }

    public function getTransactionDetails(){
        $txn_details = array_except($this->toArray(),['id','token','transactionable_id','transactionable_type','created_at','updated_at','payment_id']);
        $txn_details['txn_method_details'] = array_except($this->transactionable->first()->toArray(),['id','created_at','updated_at']);
        return $txn_details;
    }
}