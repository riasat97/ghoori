<?php

class OrderRejectionReason extends \Eloquent {
	protected $guarded = [];
    protected $table = 'orderrejectionreasons';

    public function rejectionreason(){
        return $this->belongsTo('RejectionReason','rejectionreason_id');
    }

}