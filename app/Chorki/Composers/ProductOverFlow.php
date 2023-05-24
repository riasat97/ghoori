<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/15/2016
 * Time: 4:20 PM
 */

namespace Chorki\Composers;


use Chorki\products\Models\ProductRepositoryInterface;

class ProductOverFlow {

    protected $productRepository;

    function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function compose($view){
        $viewData= $view->getData();
        $productOverFlow=$this->productRepository->areProductsOverFlown($viewData['shop']);
        $view->with('productOverFlow',$productOverFlow);
    }
}