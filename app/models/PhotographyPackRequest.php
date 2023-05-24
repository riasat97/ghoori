<?php

use Chorki\Payment\Traits\PaymentableTrait;

class PhotographyPackRequest extends \Eloquent {
    protected $table = 'photographypackrequest';
	protected $guarded = [];
	use PaymentableTrait;
	public function shop(){
        return $this->belongsTo('Chorki\shops\Models\Shop','shop_id');
    }

    public function package(){
        return $this->belongsTo('PhotographyServicePackage','photography_service_package_id');
    }

    public function onPaymentComplete() {
    	$this->isPaid = true;
        $this->save();
    }
}