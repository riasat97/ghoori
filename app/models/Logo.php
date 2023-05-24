<?php

class Logo extends \Eloquent {

    protected static $rules = [];
    protected $fillable = ['logo','shop_id','tempKey'];


    public function shop() {
        return $this->belongsTo('Chorki\shops\Models\Shop');
    }
}