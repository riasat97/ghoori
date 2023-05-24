<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 5/18/2015
 * Time: 8:50 PM
 */

class ShippingPackage extends \Eloquent{

    protected $table='shippingpackages';
    protected $guarded=[''];

    public function shippingChannel(){
        return $this->belongsTo('\ShippingChannel','shippingChannel_id');
    }
}