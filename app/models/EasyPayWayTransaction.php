<?php

class EasyPayWayTransaction extends \Eloquent {
    protected $primarykey = 'mer_txnid';
    protected $table = 'easy_pay_way_transactions';
	protected $fillable = [ 'epw_txnid', 'mer_txnid', 'amount', 'pay_status', 'cardnumber', 'payment_processor',
                            'bank_trxid', 'payment_type', 'error_code', 'error_title', 'bin_country', 'bin_issuer',
                            'bin_cardtype', 'bin_cardcategory', 'date_processed', 'rec_amount',
                            'processing_ratio', 'processing_charge', 'ip'];

    public function createNewTransaction(){
        do{
            $transactionId = md5(uniqid(time(),true));
            $transactionIdWithSameId = $this->where('mer_txnid', $transactionId)->first();
        }while($transactionIdWithSameId);

        $epw_transaction = $this->create(['mer_txnid'=>$transactionId]);
        $epw_transaction->save();
        return $epw_transaction;
    }
}