<?php

namespace Chorki\Payment\Models;

class BKashTransaction extends \Eloquent {
	protected $fillable = ['trxId','trxStatus','reversed','service','sender','receiver',
                            'currency','amount','reference','counter','trxTimestamp'];
    protected $table = 'bkash_transactions';

    public function transaction(){
        return $this->morphMany('Chorki\Payment\Models\Transaction', 'transactionable');
    }
}