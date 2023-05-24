<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 1/7/2016
 * Time: 1:00 PM
 */

namespace Chorki\Composers;


use Chorki\themes\products\ThemeProductRepository;

class ThemeSideBarProductsComposer {

    protected $themeProductRepository;



    function __construct(ThemeProductRepository $themeProductRepository)
    {
        $this->themeProductRepository = $themeProductRepository;

    }

    public function compose($view){
        $viewData= $view->getData();
        $latestProducts=$this->themeProductRepository->getSortedProducts($viewData['shop'],'desc',5,true);
        $popularProducts=$this->themeProductRepository->getHighestSoldProducts($viewData['shop'],5,true);

        $view->with(['latestProducts'=>$latestProducts,'popularProducts'=>$popularProducts]);
    }
}