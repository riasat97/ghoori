<?php

class PackageRequest extends \Eloquent {
    protected $table = 'packagerequests';
	protected $guarded = [];
    protected $dates = ['accepted_at'];

    public function shop(){
        return $this->belongsTo('Chorki\shops\Models\Shop');
    }
    public function package(){
        return $this->belongsTo('\Package');
    }
}