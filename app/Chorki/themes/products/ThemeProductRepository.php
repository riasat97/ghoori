<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 12/30/2015
 * Time: 3:10 PM
 */

namespace Chorki\themes\products;


use Carbon\Carbon;
use Chorki\Category\CategoryRepository;
use Chorki\Category\SubCategory\SubCategoryRepository;
use Chorki\products\Models\Product;
use Chorki\shops\Models\ShopRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ThemeProductRepository {

    protected $product;
    protected $category;
    protected $subcategory;
    protected $shop;
    protected $cache;
    function __construct(Product $product,
                         CategoryRepository $category,
                         SubCategoryRepository $subcategory,
                           ShopRepositoryInterface $shop,Cache $cache)
    {
        $this->product = $product;
        $this->category = $category;
        $this->subcategory = $subcategory;
        $this->shop = $shop;
        $this->cache = $cache;
    }
    public function getSearchProductsByCategory($slug){
      $shop=$this->shop->getBySlug($slug);
      $categoryId=Input::get('categoryId');
      $category= empty($categoryId)?null:$this->category->getById($categoryId)->name;
      $products=$this->getProducts($shop,$categoryId,'category_id',20,true);
      return ['products'=>$products,'category'=>$category];
    }
    public function getShopProducts($shop){
        $products=[];
        $subCategories=[];
        $categories= $this->getUniqueCategories($shop);
        foreach ($categories as $key=>$category) {
          $subCategories[$key] = $this->getSubCategories($shop,$key);
             $subcats= $this->getSubCategories($shop,$key);

                    foreach($subcats as $id=>$subCat){

                    $products[$key][$id]=$this->getProducts($shop,$id);
                }
            }

        return ['products'=>$products,'categories'=>$categories,'subCategories'=>$subCategories];

    }
    public function getCategoryTree($shop){

        $subCategories=[];
        $categories= $this->getUniqueCategories($shop);
        foreach ($categories as $key=>$category) {

            $subCategories[$key] = $this->getSubCategories($shop,$key);

        }
        $catTree=['categories'=>$categories,'subCategories'=>$subCategories];
        $key = md5('Chorki.'.$shop->id);

        if(Cache::has($key))
        {
            return Cache::get($key);
        }
        $expiresAt = Carbon::now()->addMinutes(15);
        Cache::put($key, $catTree,$expiresAt);
        return $catTree;

    }
    protected function getUniqueCategories($shop){
         $category = [];

            $categoryIds= $this->product
             ->where('products.status', 'Published')
             ->where('products.shop_id',$shop->id)
             ->join('categories','products.category_id','=','categories.id')
             ->distinct('products.category_id')
             ->orderBy('category_id')
             ->lists('category_id');

        foreach ($categoryIds as $categoryId) {

           $category[$categoryId] = $this->category->getById($categoryId)->name;
        }
        return $category;

    }

    protected function getProducts($shop,$key,$condition='subCategory_id',$limit=20,$textSearch=false)
    {
       return
         $products= $this->product
         ->where('products.status', 'Published')
         ->withimages()
        ->like('name',Input::get('name'),$textSearch)
        ->with('shop')
        ->where('shop_id',$shop->id)
        ->condition($condition,$key)
        ->orderBy('category_id')
        ->orderBy('subCategory_id')
        ->paginate($limit);
    }

    protected function getSubCategories($shop,$key)
    {
        $subCategories = [];

        $subCategoryIds= $this->product
            ->where('products.status', 'Published')
            ->where('products.shop_id',$shop->id)
            ->where('products.category_id',$key)
            ->join('subcategories','products.subCategory_id','=','subcategories.id')
            ->distinct('products.subCategory_id')
            ->orderBy('subCategory_id')
            ->lists('subCategory_id');
        foreach ($subCategoryIds as $subCategoryId) {

            $subCategories[$subCategoryId] = $this->subcategory->getById($subCategoryId)->name;
        }
        return $subCategories;

     /* return  $subCategories= $this->subcategory
            ->where('category_id',$key)
            ->lists('name','id');*/


    }
    public function getProductsByCategory($slug,$category){
        $shop=$this->shop->getBySlug($slug);
        $categoryId=$this->category->getByName($category)->id;
        $subCategoryId=$this->getSubCategoryId();
        return $products= $this->getCategoryWiseProducts($shop,$categoryId,$subCategoryId);
    }

    private function getSubCategoryId()
    {
        $subCategory=Input::get('sub-category');
        if(!empty($subCategory)){
            return $this->subcategory->getByName($subCategory)->id;
        }
        return null;

    }

    private function getCategoryWiseProducts($shop, $categoryId, $subCategoryId)
    {
        if($subCategoryId){
           return $this->getProducts($shop,$subCategoryId);
        }
        return $this->getProducts($shop,$categoryId,'category_id');
    }
    public function getHighestSoldProducts($shop,$limit=3,$cache=false)
    {
        $products= $this->product
            ->where('products.status', 'Published')
            ->where('products.shop_id',$shop->id)
            ->with('shop')
            ->join('order_product', 'products.id', '=', 'order_product.product_id')
            ->select('products.*',
                DB::raw('(select imageLink from images where product_id  =   products.id  order by id asc limit 1)
                as image'),
                'products.id As productId','products.name As productName',
                'products.price As productPrice',
                'order_product.id As order_product_Id','order_product.price As orderedPrice',
                DB::raw('SUM(quantity) as maxSoldCount'))
            ->orderBy('maxSoldCount', 'desc')
            ->groupBy('order_product.product_id')
            ->take($limit)->get();
        return  $cache?cacheQuery(md5('getHighestSoldProducts'),$products,$this->getExpireTime()):$products;

    }
    public function getSortedProducts($shop,$sort='desc',$limit=5,$cache=false)
    {

            $products= $this->product
                ->where('products.status', 'Published')
                ->withimages()
                ->with('shop')
                ->where('shop_id',$shop->id)
                ->orderBy('id',$sort)
                ->orderBy('category_id')
                ->orderBy('subCategory_id')
                ->take($limit)
                ->get();
     return  $cache?cacheQuery(md5('getSortedProducts'),$products,$this->getExpireTime()):$products;
    }
    public function getExpireTime(){
        return  Carbon::now()->addMinutes(15);
    }

}