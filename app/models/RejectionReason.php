<?php

class RejectionReason extends \Eloquent {
    protected $guarded = [];
    protected $table = 'rejectionreasons';

    public function orderRejectionType(){
        return $this->belongsTo('OrderRejectionType','orderrejectiontype_id');
    }
    public function scopeDuringPlacement($query)
    {
        $query->where('orderrejectiontypes.type','during placement')
        ->selectreasons();
    }
    public function scopeDuringDelivery($query)
    {
        $query->where('orderrejectiontypes.type','during delivery')
            ->selectreasons();
    }
    public function scopeSelectReasons($query){
        $query->select('*','rejectionreasons.id as rejectionReasonId','orderrejectiontypes.id as orderRejectiontypeId');
    }

    public function scopeJoinRejectionType($query){
        $query->join('orderrejectiontypes','rejectionreasons.orderrejectiontype_id','=','orderrejectiontypes.id');
    }

}