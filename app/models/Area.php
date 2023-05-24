<?php

class Area extends \Eloquent {

    protected static $rules = [];
	protected $fillable = ['name'];


    public function districts() {
        return $this->belongsTo('District');
    }
}