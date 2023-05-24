<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 5/17/2015
 * Time: 9:14 PM
 */

namespace Chorki\Shippings\ShippingAddresses\Models;


class ShippingAddress extends \Eloquent{
    protected $table='shippingaddresses';
    protected $guarded=[];

    public function user(){
        return $this->belongsTo('\User');
    }
    public function order(){
        return $this->belongsTo('Chorki\Orders\Models\Order','order_id');
    }
    public function code(){
        return $this->hasOne('\VerificationCode','shippingAddress_id');
    }

}