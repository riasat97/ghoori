<?php

class WinterIsHere extends \Eloquent {
	protected $guarded = [];
    protected $table = 'winterishere';
    protected $dates = ['ended_at'];

    public function product(){
        return $this->belongsTo('Chorki\products\Models\Product');
    }
}