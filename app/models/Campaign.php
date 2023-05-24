<?php

class Campaign extends \Eloquent {
	protected $fillable = ['name','className','active'];

    public function products(){
        return $this->belongsToMany('Chorki\products\Models\Product');
    }
    public function shops(){
        return $this->belongsToMany('Chorki\shops\Models\Shop');
    }
    public function coupons(){
        return $this->hasMany('Coupon');
    }
}