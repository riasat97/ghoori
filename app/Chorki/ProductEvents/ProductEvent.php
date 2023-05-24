<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 1/21/2016
 * Time: 3:20 PM
 */

namespace Chorki\ProductEvents;


use App\Model\ProductEventLogger;
use Chorki\products\Models\ProductRepositoryInterface;
use Chorki\shops\Models\ShopRepositoryInterface;
use Chorki\Traits\ProductEvents\ProductEventTrait;

class ProductEvent {
    use ProductEventTrait;
    protected $productEventLogger,$shopRepositoryInterface,$productRepositoryInterface;

    function __construct(ProductEventLogger $productEventLogger,ShopRepositoryInterface $shopRepositoryInterface,
                         ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productEventLogger = $productEventLogger;
        $this->shopRepositoryInterface = $shopRepositoryInterface;
        $this->productRepositoryInterface = $productRepositoryInterface;
    }
    public function postProductsDependsOnShopStatus($shop){
     $publishedProducts= $this->getPublishedProducts($shop);
     if($shop->status == 'Published'){

      foreach($publishedProducts->products as $key=>$product){
          $productEventLogger= $this->getProductEventLoggerObject($product);
          $this->postProductEvent($productEventLogger,'add');

      }
     }
     elseif($shop->status == 'Unpublished'){
        foreach($publishedProducts->products as $key=>$product){
            $productEventLogger= $this->getProductEventLoggerObject($product);
            $this->postProductEvent($productEventLogger,'delete');
           // $this->productEventLogger->where('product_id',$product->id)->update(['event'=>'delete']);
        }

     }
    }
    public function postProduct($shop,$product,$edited=false)
    {
        $productEventLogger = $this->getProductEventLoggerObject($product);
        if ($shop->status == 'Published' && $product->status == 'Published') {
            $edited ? $this->postProductEvent($productEventLogger, 'edit') :
                $this->postProductEvent($productEventLogger, 'add');
        } elseif ($shop->status == 'Published' && $product->status == 'Unpublished') {
            $this->postProductEvent($productEventLogger, 'delete');
        }
    }
    public function postProductDependsOnStock($product){
      $stock=$product->stock;
      $productEventLogger = $this->getProductEventLoggerObject($product);
        if($stock){
          $this->postProductEvent($productEventLogger, 'add');
      }
      else{
          $this->postProductEvent($productEventLogger, 'delete');
      }
    }





}