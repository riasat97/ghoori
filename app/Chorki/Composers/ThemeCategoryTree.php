<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 1/5/2016
 * Time: 6:30 PM
 */

namespace Chorki\Composers;


use Carbon\Carbon;
use Chorki\themes\products\ThemeProductRepository;
use Illuminate\Support\Facades\Cache;

class ThemeCategoryTree {


    protected $themeProductRepository;

    protected $cache;

    function __construct(ThemeProductRepository $themeProductRepository,Cache $cache)
    {
        $this->themeProductRepository = $themeProductRepository;
        $this->cache = $cache;
    }

    public function compose($view){
        $viewData= $view->getData();
        $categories=$this->themeProductRepository->getCategoryTree($viewData['shop']);

        $view->with('categories',$categories);
   }
}