<?php

class ShippingWeight extends \Eloquent {
    protected $table='shippingweights';
    protected $guarded=[''];

    public function shippingChannel(){
        return $this->belongsTo('\ShippingChannel');
    }
}