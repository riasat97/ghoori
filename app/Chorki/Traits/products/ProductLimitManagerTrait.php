<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 2/28/2016
 * Time: 3:36 PM
 */

namespace Chorki\Traits\products;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

trait ProductLimitManagerTrait {

    public function getProductLimitAccordingToShopPackage($shop){
        $package=$shop->package;

        return $limit=Config::get('productlimit.'.$package->name);

    }
    public function areProductsOverFlown($shop){
     $limit=$this->getProductLimitAccordingToShopPackage($shop);
     $count=$this->totalItemsForShop($shop->slug);
     $status = ($count>$limit)?true:false;
     return ['status'=>$status,'count'=>$count,'limit'=>$limit];
    }
}