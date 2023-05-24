<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 5/17/2015
 * Time: 7:37 PM
 */

namespace Chorki\Orders\Models;


use Illuminate\Support\Facades\DB;

class Order extends \Eloquent{

    protected $table='orders';
    protected $guarded=[];
    protected $dates = ['completed_at'];

    public function scopeOrderCompletedByShop($query,$shopId){
        $query->where('shop_id',$shopId)
              ->where('status','Complete');
    }
    public function scopeLoadOrders($query)
    {
        $query->with('user','shippingAddress','shippingPackage','paymentMethod','shippingLocation','products','orderRejectionReason');

    }
    public function scopeAssociateShop($query,$shopId=null){
        if(!empty($shopId) && !is_array($shopId)){
            $query->where('shop_id',$shopId);
        }
        if(is_array($shopId)){
            $query->whereIn('shop_id',$shopId);
        }


    }

    public function scopeGroupByShop($query,$groupBy=true){
        if($groupBy){
            $query->groupBy('shop_id');
        }

    }
    public function scopeOwnChannelCharge($query,$cod){
       if($cod){
          $query->select('*',
              DB::raw('SUM(Round(subtotal,2)) as totalPaymentReceived'))
          ->where('paymentMethod_id',1);
       }else
       {
           $query->select('*',
               DB::raw('SUM(Round(shippingCharge,2)) as totalOwnChannelCharge'));
       }

    }
    public function user(){
        return $this->belongsTo('\User');
    }
    public function shop(){
        return $this->belongsTo('Chorki\shops\Models\Shop');
    }
    public function shippingAddress(){
        return $this->hasOne('Chorki\Shippings\ShippingAddresses\Models\ShippingAddress','order_id');
    }
    public function shippingPackage(){
        return $this->belongsTo('\ShippingPackage','shippingPackage_id');
    }
    public function paymentMethod(){
      return $this->belongsTo('\PaymentMethod','paymentMethod_id');
    }
    public function shippingLocation(){
        return $this->belongsTo('\ShippingLocation','shippingLocation_id');
    }
    public function products()
    {
        return $this->belongsToMany('Chorki\products\Models\Product')->withPivot('quantity','price','lineTotal','color','size','productName','discount','discountComment');
    }
    public function orderRejectionReason(){
        return $this->hasOne('\OrderRejectionReason','order_id');
    }
    public function generalStatuses(){
        return $this->hasMany('\GeneralStatus');
    }
    public function parcelLogs(){
        return $this->hasMany('\ParcelLog');
    }

}