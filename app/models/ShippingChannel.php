<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 5/18/2015
 * Time: 7:44 PM
 */

class ShippingChannel extends \Eloquent {

    protected $table='shippingchannels';
    protected $guarded=[''];

    public function shops(){
        return $this->belongsToMany('Chorki\shops\Models\Shop');
    }
    public function shippingPackages(){
        return $this->hasMany('\ShippingPackage','shippingChannel_id');
    }
    public function shippingWeights(){
        return $this->hasMany('\ShippingWeight','shippingChannel_id');
    }
}