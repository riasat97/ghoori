<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 5/18/2015
 * Time: 5:21 PM
 */

class PaymentMethod extends \Eloquent{

    public static $rules = [
        'paymentMethod_id' => 'required'
    ];
    protected $table='paymentmethods';
    protected $guarded=[''];

    public function shops(){

        return $this->belongsToMany('Chorki\shops\Models\Shop');
    }
}