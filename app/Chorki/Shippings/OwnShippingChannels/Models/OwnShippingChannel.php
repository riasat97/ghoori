<?php
namespace Chorki\Shippings\OwnShippingChannels\Models;

class OwnShippingChannel extends \Eloquent {
    protected $guarded = [];
    protected $table='ownshippingchannels';
    protected $date=['accepted_at'];

    public function shop(){
        return $this->belongsTo('Chorki\shops\Models\Shop');
    }

}