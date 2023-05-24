<?php

namespace Chorki\Traits\products;

use Carbon\Carbon;
use Chorki\products\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

trait SimilarProductTrait{

    /**
     * @var Product
     */

    public function __construct(){

    }

    public function getRelatedProducts($data){
        $simProducts = $this->similarProductsQuery($data);
        return $simProducts;
    }

    private function getCurrentProduct($productId){
        $product = $this->model
            ->select('products.id AS id','products.name AS title','shops.subDomain AS subDomain',
                'categories.name AS category_name','subcategories.name AS subcategory_name','subsubcategories.name AS subsubcategory_name')
            ->join('shops','shops.id','=','products.shop_id')
            ->leftJoin('categories','categories.id','=','products.category_id')
            ->leftJoin('subcategories','subcategories.id','=','products.subcategory_id')
            ->leftJoin('subsubcategories','subsubcategories.id','=','products.subSubCategory_id')
            ->where('products.id',$productId)->first();
        return $product;
    }

    private function similarProductsQuery($data){
        $productId = $data['productId'];
        $product = $this->getCurrentProduct($productId);
        $categoryArray = $this->getCategoryArray($product);
        $categoryArrayKey = array_keys($categoryArray);
        $categoryArrayValue = array_values($categoryArray);

        $globalQueryHead = 'http://103.239.252.141:2016/search/related/?';
        $globalQueryTail="&rows=20";
        $queryHead = 'http://103.239.252.141:8983/solr/chorkiSearch/select?q=';
        $queryTail = '&fl=*&rows=20&sort=hit desc';

        if(count($categoryArray)>0) {
            for ($i = 0; $i < count($categoryArray); $i++) {
                if ($i == 0) {
                    $temp = '';
                    if ($data['sameShop'] == 1) {
                        $temp = $queryHead . $categoryArrayKey[0] . ':"' . $categoryArrayValue[0] . '" AND -id:' . $data['productId'] . ' AND subDomain:"' . $product->subDomain.'" ' . $queryTail;
                    } else {
                        $temp = $queryHead . $categoryArrayKey[0] . ':"' . $categoryArrayValue[0] . '" AND -id:' . $data['productId'].' AND -subDomain:"' . $product->subDomain.'" ' . $queryTail;
                    }
                    $globalQueryHead .= 'query' . ($i + 1) . '=' . urlencode($temp);
                } else {
                    $str='';
                    for($j=0;$j<$i;$j++){
                        $str = $str.' AND -'.$categoryArrayKey[$j].':"'.$categoryArrayValue[$j].'" ';
                    }
                    if ($data['sameShop'] == 1) {
                        $temp = $queryHead . $categoryArrayKey[$i] . ':"' . $categoryArrayValue[$i] . '" '.$str. ' AND subDomain:"' . $product->subDomain.'" ' . $queryTail;
                        $globalQueryHead .= '&' . 'query' . ($i + 1) . '=' . urlencode($temp);
                    }else{
                        $temp = $queryHead . $categoryArrayKey[$i] . ':"' . $categoryArrayValue[$i] . '" '.$str. 'AND -subDomain:"' . $product->subDomain.'" ' . $queryTail;
                        $globalQueryHead .= '&' . 'query' . ($i + 1) . '=' . urlencode($temp);
                    }
                }
            }
            $query = $globalQueryHead.$globalQueryTail;
            $similarProductData = json_decode(file_get_contents($query));
            $similarProductData = ($similarProductData->docs!=null)?$this->getCustomizedData($similarProductData->docs):[];
            return $similarProductData;
        }else{
            return $similarProductData=[];
        }
    }

    private function getCategoryArray($product){
        $categoryArray=[];

        if($product->subsubcategory_name != Null){
            $categoryArray['subsubcategory_name'] = $product->subsubcategory_name;
        }
        if($product->subcategory_name != Null){
            $categoryArray['subcategory_name'] = $product->subcategory_name;
        }
        if($product->category_name != Null){
            $categoryArray['category_name'] = $product->category_name;;
        }
        return $categoryArray;
    }

    private function getCustomizedData($data){
        $customizedData = [];
        foreach ($data as $item){

            $customizedData =  array_merge($customizedData,$item);
        }

        return $customizedData;
    }

}