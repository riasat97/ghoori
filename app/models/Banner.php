<?php

class Banner extends \Eloquent {

    protected static $rules = [];
	protected $fillable = ['path','shop_id','tempKey'];


    public function shop() {
        return $this->belongsTo('Shop');
    }
}