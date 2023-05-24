<?php


class District extends \Eloquent {

    //public $timestamps = false;     //added to enable insertion, MOHSIN
    protected static $rules = [];
    protected $fillable = ['name'];

    //protected $table = 'districts';

    public function areas() {
        return $this->hasMany('Area');
    }

    public function divisions() {
        return $this->belongsTo('Division');
    }

}
