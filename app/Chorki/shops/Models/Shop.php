<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/18/2015
 * Time: 11:27 AM
 */

namespace Chorki\shops\Models;

use Chorki\shops\Events\ShopWasPosted;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Laracasts\Commander\Events\EventGenerator;
use Illuminate\Database\Eloquent\SoftDeletingTrait;


class Shop extends \Eloquent implements SluggableInterface
{
    use EventGenerator;
    use SluggableTrait;
    use SoftDeletingTrait;

    protected $sluggable = array(
        'build_from' => 'subDomain',
        'save_to'    => 'slug',
        'unique'     => true,
    );

    public function slugCheck()
    {
        if(!$this->getSlug()) // Is slug empty
        {
            $this->sluggify();      // Create slug
            $this->save();          // Save slug to database
        }
        return $this->getSlug();    // return the slug to echo out
    }

    protected static $rules = [];
    protected $guarded = [''];
    protected $dates = ['migrated_at','ownChannel_at'];
    public static function post($title, $description, $address, $email, $mobile,$user_id,$subDomain,$pickUpAddress,$package_id){
        $emailVerificationCode= self::generateVerificationCode('emailVerificationCode');
        $shop = new static(compact('title','description','address','email','mobile','user_id','subDomain',
                          'emailVerificationCode','pickUpAddress','package_id'));

        $shop->raise(new ShopWasPosted($shop));

        return $shop;

    }
    public function scopeWithProducts($query){
        $query->where('shops.status','Published')->where('shops.chorkiVerified',1)
            ->join('products', 'shops.id', '=', 'products.shop_id')
            ->join('images','products.id','=','images.product_id')
            ->where('products.status', 'Published')
            ->whereNull('products.deleted_at');

    }
    public function banner()
    {
        return $this->hasOne('Banner');
    }

    public function division()
    {
        return $this->belongsTo('Division');
    }

    public function products()
    {
        return $this->hasMany('Chorki\products\Models\Product');
    }

    public function code(){
        return $this->hasOne('\VerificationCode');
    }

    public function url()
    {
        return Url::to($this->slug);
    }
    public function user(){
        return $this->belongsTo('User');
    }
    public function logo(){
        return $this->hasOne('\Logo');
    }

    public function shopPrivacy(){
        return $this->hasOne('\ShopPrivacy');
    }
    public function shopTerm(){
        return $this->hasOne('\ShopTerm');
    }
    public function paymentMethods(){
        return $this->belongsToMany('\PaymentMethod','paymentmethod_shop','shop_id','paymentMethod_id')
               ->withTimestamps();
    }
    public function paymentMethodLogs(){
        return $this->belongsToMany('\PaymentMethod','paymentMethodLog','shop_id','paymentMethod_id')
            ->withPivot('status')
            ->withTimestamps();
    }
    public function shippingChannels(){
        return $this->belongsToMany('\ShippingChannel','shippingchannel_shop','shop_id','shippingChannel_id')
               ->withTimestamps();
    }

    public function shopSocialNetwork(){
        return $this->hasOne('\ShopSocialNetwork');
    }
    public function ownShippingChannels(){
        return $this->hasMany('Chorki\Shippings\OwnShippingChannels\Models\OwnShippingChannel');
    }
    public function shippingLocations(){
        return $this->belongsToMany('\ShippingLocation','shop_shippinglocation','shop_id','shippingLocation_id')->withPivot('unitCost');
    }
    public function ecourierRegistration(){
        return $this->hasOne('\EcourierRegistration');
    }
    public static function generateVerificationCode($requiredVerificationCode){
        do{
            $verificationCode = md5(uniqid(time(),true));
            $shopWithSameVerificationCode = Shop::where($requiredVerificationCode, $verificationCode)->first();
        }while($shopWithSameVerificationCode);
        return $verificationCode;
    }
    public function campaigns(){
        return $this->belongsToMany('\Campaign');
    }
    public function generalStatuses(){
        return $this->hasMany('\GeneralStatus');
    }

    public function package(){
        return $this->belongsTo('\Package');
    }
    public function packageRequests(){
        return $this->hasMany('\PackageRequest');
    }
    public function bank(){
        return $this->hasOne('\Bank');
    }
    public function bkash(){
        return $this->hasOne('\Bkash');
    }
    public function facebookShop(){
        return $this->hasOne('FacebookShop');
    }

    public function theme() {
        return $this->belongsTo('\Theme', 'theme_id');
    }

    public function themeBanners() {
        return $this->hasMany('\ThemeBanner', 'shop_id');
    }
    public function journals(){
        return $this->hasMany('\Journal','shop_id');
    }

    function photographyPackRequest(){
        return $this->hasMany('PhotographyPackRequest','shop_id');
    }

}



