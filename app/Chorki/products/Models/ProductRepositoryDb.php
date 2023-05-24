<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/15/2015
 * Time: 3:48 PM
 */

namespace Chorki\products\Models;
use Chorki\Repositories\DbRepositories;
use Chorki\shops\Models\ShopRepositoryInterface;
use Chorki\Traits\products\ProductLimitManagerTrait;
use Chorki\Traits\products\SimilarProductTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Paginator;

class ProductRepositoryDb extends DbRepositories implements  ProductRepositoryInterface{

    use SimilarProductTrait;
    use ProductLimitManagerTrait;
    protected $model;
    protected $shop;

    function __construct(Product $model,ShopRepositoryInterface $shop)
    {
        $this->model = $model;
        $this->shop = $shop;
    }

    public function save(Product $product)
    {

        $saved= $product->save();
        return $saved;

    }
    public function delete($id){

        return $this->model->destroy($id);

    }
    public function getPublishedByPage($shop_id, $page = 1, $limit = 20,$shopProductLimit = 24){
        $shopProductLimit = $shopProductLimit+1;
        $results = new \stdClass();
        $results->page = $page;
        $results->limit = $limit;
        $results->totalItems = 0;
        $results->items = array();
        $products = $this->model->withTrashed()->

        from(DB::raw("( SELECT * FROM products where shop_id=$shop_id AND deleted_at is null
        LIMIT $shopProductLimit) as derivedProducts "))
        ->where('status','Published')
        ->orderBy('id', 'DESC')
        ->skip($limit * ($page - 1))->take($limit)->with('images')->get();
        $results->totalItems = $this->model->count();
        $results->items = $products->all();
        return $results;
    }
    public function getByPage($shop_id, $page = 1, $limit = 20){
        $results = new \stdClass();
        $results->page = $page;
        $results->limit = $limit;
        $results->totalItems = 0;
        $results->items = array();
        $products = $this->model->withTrashed()
        ->from(DB::raw("( SELECT * FROM products where shop_id=$shop_id AND deleted_at IS NULL
          ORDER BY id desc) as derivedProducts "))
        ->orderBy('status')
        ->skip($limit * ($page - 1))->take($limit)->with('images')->get();
        $results->totalItems = $this->model->count();
        $results->items = $products->all();
        return $results;
    }
    public function totalItemsForShop($slug){
        $shop= $this->shop->getBySlug($slug);
        $count=$shop->products()->count();
        return $count;
    }

    public function totalPublishedItemsForShop($slug,$productLimit){
        $shop= $this->shop->getBySlug($slug);
        $count=$shop->products()->where('status','Published')->take($productLimit)->get();
        return $count->count();
    }

    public function processWeight($weight, $weightUnit)
    {
        if($weightUnit ==='kg'){
            return $weightInGm=$weight*1000;
        }
        else{
            return $weight;
        }
    }
    public function getAllNewestProducts()
    {
        return DB::table('shops')->where('shops.status','Published')->where('shops.chorkiVerified',1)
            ->join('products', 'shops.id', '=', 'products.shop_id')
            ->join('images','products.id','=','images.product_id')
            ->where('products.status', 'Published')
            ->whereNull('products.deleted_at')
            ->select('*','shops.id As shopId','shops.title As shopTitle','products.id As productId')
            ->groupBy('productId')
            ->orderBy('products.id', 'desc')->take(10)->get();
    }

    public function getHighestViewedProducts()
    {
        return DB::table('shops')->where('shops.status','Published')->where('shops.chorkiVerified',1)
            ->join('products', 'shops.id', '=', 'products.shop_id')
            ->join('images','products.id','=','images.product_id')
            ->where('products.status', 'Published')
            ->whereNull('products.deleted_at')
            ->select('*','shops.id As shopId','shops.title As shopTitle','products.id As productId')
            ->groupBy('productId')
            ->orderBy('products.hits', 'desc')->take(20)->get();

    }

    public function getHighestSoldProducts()
    {
        return DB::table('shops')->where('shops.status','Published')->where('shops.chorkiVerified',1)
            ->join('products', 'shops.id', '=', 'products.shop_id')
            ->join('images','products.id','=','images.product_id')
            ->join('order_product', 'products.id', '=', 'order_product.product_id')
            ->where('products.status', 'Published')
            ->whereNull('products.deleted_at')
            ->select('*','shops.id As shopId','shops.title As shopTitle','products.id As productId','products.price As productPrice','order_product.id As order_product_Id','order_product.price As orderedPrice',DB::raw('SUM(quantity) as maxSoldCount'))
            ->orderBy('maxSoldCount', 'desc')
            ->groupBy('order_product.product_id')
            ->take(10)->get();
    }

    public function getFeaturedProducts()
    {
        /*return DB::table('shops')->where('shops.status','Published')->where('shops.chorkiVerified',1)
          ->rightJoin('featuredshops', 'shops.id', '=', 'featuredshops.shop_id')

          ->join(DB::raw('(SELECT * FROM products ORDER BY rand() ) products'), function($join)
       {
             $join->on('shops.id', '=', 'products.shop_id');
       })   
         ->join(DB::raw('(SELECT * FROM images GROUP BY images.product_id) images '), function($join)
       {
             $join->on('products.id', '=', 'images.product_id');
       })  
          ->where('products.status', 'Published')
          ->whereNull('products.deleted_at')
          ->select('*','shops.id As shopId','shops.title As shopTitle','products.id As productId')
          ->orderBy('shopId')
          ->get();*/
          return DB::table('shops')->where('shops.status','Published')->where('shops.chorkiVerified',1)
            ->rightJoin('featuredshops', 'shops.id', '=', 'featuredshops.shop_id')
            ->join('products', 'shops.id', '=', 'products.shop_id')
            ->join('images','products.id','=','images.product_id')
            ->where('products.status', 'Published')
            ->whereNull('products.deleted_at')
            ->select('*','shops.id As shopId','shops.title As shopTitle','products.id As productId')
            ->groupBy('shops.id')
            ->orderBy('products.hits', 'asc')->get();
    }

    public function ProductHasGpCampaign($product)
    {
        $productHasCampaign=$product->campaigns()->where('campaigns.id',1)->first();
         /*dd($productHasCampaign);*/
        if($productHasCampaign && $productHasCampaign->active){
           $discount= $product->price*10/100;
           return $discountedPrice = round($product->price - $discount);
        }
        else{

            return false;
        }
    }
    public function viewCount($product)
    {
        $this->countviewer($product,'productview','product_id');
    }

    public function getShopProducts($shop){
        $currentPage = Input::get('page', 1);

        $itemsPerPage = 3;
      //  $productLimit=$this->getProductLimitAccordingToShopPackage($shop);
        $data = $this->getByPage($shop->id,$currentPage, $itemsPerPage);
        $totalItems= $this->totalItemsForShop($shop->slug);
        return $products = Paginator::make($data->items, $totalItems, $itemsPerPage);
    }

}