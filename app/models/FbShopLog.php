<?php

class FbShopLog extends \Eloquent {
	protected $guarded = [];
    protected $table='fbshoplogs';

    public function facebookShop(){
        return $this->belongsTo('FacebookShop','facebookShop_id');
    }
}