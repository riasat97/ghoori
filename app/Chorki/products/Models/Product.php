<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/11/2015
 * Time: 11:50 AM
 */

namespace Chorki\products\Models;

use Chorki\Campaigns\CampaignInterface;
use Chorki\products\Events\ProductWasPosted;
use Illuminate\Support\Facades\DB;
use Laracasts\Commander\Events\EventGenerator;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Product extends \Eloquent{

    use EventGenerator;
    use SoftDeletingTrait;
    // Add your validation rules here
    public static $rules = [];
    protected $dates = ['deleted_at'];
    // Don't forget to fill this array

    protected $guarded = [''];

    public function scopeWithImages($query){
        $query->
        select( 'products.*',
        DB::raw('(select imageLink from images where product_id  =   products.id  order by id asc limit 1)
        as image')  );
    }

    public  function scopeLike($query, $field, $value,$textSearch){
              if($textSearch){
                  return $query->where($field, 'LIKE', "%$value%");
              }
    }
    public function scopeCondition($query,$condition,$key){

        if(!empty($key)){
            return $query->where($condition,$key);
        }
      /*  return $query->where('1=1');*/
    }

    public static function post($name,$description,
                                $price,$category_id,$subcategory_id,$subSubCategory_id,$stock,$weight,$weightunit,$shop_id){
        $weight= self::processWeight($weight,$weightunit);
        $product = new static(compact('name', 'description',
            'price','category_id','subcategory_id','subSubCategory_id','stock','weight','weightunit','shop_id'));

        $product->raise(new ProductWasPosted($product));

        return $product;
    }
    
    public function shop(){
        return $this->belongsTo('Chorki\shops\Models\Shop','shop_id');
    }

    public function category(){
        return $this->belongsTo('\Category');
    }
    public function subCategory(){
        return $this->belongsTo('\Subcategory','subcategory_id');
    }

    public function images(){
        return $this->hasMany('\ProductImage','product_id');
    }
    public function attributes(){
        return $this->belongsToMany('Attribute','product_attribute')->withPivot('id','value','image');
    }
    public function properties(){
        return $this->hasMany('Property');
    }

    public function campaigns(){
        return $this->belongsToMany('Campaign');
    }

    public function getActiveCampaign(){
        $productCampaign = $this->campaigns()->first();//I suppose it will have only one
        // It should go through campaignIsRunning()
        
        if ($productCampaign && $productCampaign->active){
            $discounterClass = "\\Chorki\\Campaigns\\".$productCampaign->className;
            $discounter = new $discounterClass();
            return $discounter;
        }
        return null;
    }

    public function getDiscountRate(){
        $activeCampaign = $this->getActiveCampaign();
        if($activeCampaign){
            if(!($activeCampaign instanceof CampaignInterface)){
                throw new \Exception("The given class is not an instance of CampaignInterface");
            }
            return $activeCampaign->getDiscountRate();
        }
        return null; //@todo add merchant discount after 27th december
    }

    public function getDiscountAmmount($quantity=1){
        $activeCampaign = $this->getActiveCampaign();
        if($activeCampaign){
            if(!($activeCampaign instanceof CampaignInterface)){
                throw new \Exception("The given class is not an instance of CampaignInterface");
            }
            return $activeCampaign->calculateIdealDiscount($this->price,$quantity);
        }
        return 0.0; //@todo add merchant discount after 27th december
    }

    public static function processWeight($weight, $weightUnit)
    {
        if($weightUnit ==='kg'){
            return $weightInGm=$weight*1000;
        }
        else{
            return $weight;
        }
    }

    function sponsoredItem(){
        return $this->hasOne('SponsoredItem','productId');
    }
    public function winterIsHereCampaigns(){
        return $this->hasMany('\WinterIsHere');
    }

}