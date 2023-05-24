<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 12/17/2015
 * Time: 5:40 PM
 */

namespace Chorki;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class WinterIsHereRepository {

    protected $model;

    function __construct(\WinterIsHere $model)
    {
        $this->model = $model;
    }

    public function save($product,$status=true){
    $this->model->product_id= $product->id;
    $this->model->amount = Input::get('discount');
    $this->model->status = $status;
    (!$status)?  $this->model->ended_at= Carbon::now()->toDateTimeString() :  $this->model->ended_at=null ;
    $this->model->save();
    }
    public function update($product){
     $amount=Input::get('discount');
     if($amount == '0'){
     $this->disableThis($product);
     $this->save($product,false);
     }
     else{
     $this->disableThis($product);
     $this->save($product);
     }
    }

    private function disableThis($product)
    {
        $discountedProduct=
            $this->model
                ->where('product_id',$product->id)
                ->where('status',true)
                ->first();
        if($discountedProduct){
        $discountedProduct->status = false;
        $discountedProduct->ended_at= Carbon::now()->toDateTimeString();
        $discountedProduct->update();
        }
    }
    public function getRandomDiscountedProductsForWinterCampaign(){
       $discountedProducts=
         $this->model
        ->join('products','winterishere.product_id','=','products.id')
        ->join('images','products.id','=','images.product_id')
        ->join('shops','products.shop_id','=','shops.id')
        ->join('campaign_product','campaign_product.product_id','=','products.id')
                ->join('campaigns','campaigns.id','=','campaign_product.campaign_id')
                ->where('campaigns.active', 1)
        ->whereNull('products.deleted_at')
        ->where('products.stock','>', 0)
        ->whereNull('shops.deleted_at')
        ->where('shops.status','Published')
        ->where('shops.chorkiVerified',1)
        ->where('winterishere.status',1)
        ->whereNull('winterishere.ended_at')
        ->groupBy('images.product_id')
        ->orderBy(DB::raw('RAND()'))
        ->take(8)
        ->get();
        return $discountedProducts;
        // dd($discountedProducts->toArray());
    }
    public function getRandomDiscountedProductForWinterCampaign(){
        $discountedProducts=
            $this->model
                ->join('products','winterishere.product_id','=','products.id')
                ->join('images','products.id','=','images.product_id')
                ->join('shops','products.shop_id','=','shops.id')
                ->join('campaign_product','campaign_product.product_id','=','products.id')
                ->join('campaigns','campaigns.id','=','campaign_product.campaign_id')
                ->where('campaigns.active', 1)
                ->whereNull('products.deleted_at')
                ->where('products.stock','>', 0)
                ->whereNull('shops.deleted_at')
                ->where('shops.status','Published')
                ->where('shops.chorkiVerified',1)
                ->where('winterishere.status',1)
                ->whereNull('winterishere.ended_at')
                ->groupBy('images.product_id')
                ->orderBy('winterishere.amount','desc')
                ->orderBy(DB::raw('RAND()'))
                ->first();
                return $discountedProducts;
        // dd($discountedProducts->toArray());
    }

    public function getDiscountedProductsForWinterCampaignWithPaginate()
    {
        $discountedProducts=
            $this->model
                ->select('products.*','images.*', 'winterishere.amount', 'shops.*')
                ->join('products','winterishere.product_id','=','products.id')
                ->join('images','products.id','=','images.product_id')
                ->join('shops','products.shop_id','=','shops.id')
                ->join('campaign_product','campaign_product.product_id','=','products.id')
                ->join('campaigns','campaigns.id','=','campaign_product.campaign_id')
                ->where('campaigns.active', 1)
                ->whereNull('products.deleted_at')
                ->where('products.stock','>', 0)
                ->whereNull('shops.deleted_at')
                ->where('shops.status','Published')
                ->where('shops.chorkiVerified',1)
                ->where('winterishere.status',1)
                ->whereNull('winterishere.ended_at')
                ->groupBy('images.product_id')
                // ->orderBy('winterishere.amount','desc')
                // ->take(24)->toSql();
                ->simplePaginate(24);
                // dd($discountedProducts->toArray());
                return $discountedProducts;
        // dd($discountedProducts->toArray());
    }

}