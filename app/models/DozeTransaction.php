<?php

class DozeTransaction extends \Eloquent {
	protected $table = 'doze_transactions';
    protected $guarded = [];
    public function createNewTransaction(){
        do{
            $token = strtolower(str_random(15));
            $transactionIdWithSameToken = $this->where('token', $token)->first();
        }while($transactionIdWithSameToken);

        $doze_transaction = $this->create(['token'=>$token]);
        $doze_transaction->save();
        return $doze_transaction;
    }
}