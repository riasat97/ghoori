<?php


use Chorki\shops\Models\ShopRepositoryInterface as Shop;
use Chorki\themes\products\ThemeProductRepository;

class DhumketuThemeController extends \ThemeController {

    protected $shops;
    protected $themeProductRepository;

    function __construct(Shop $shops, ThemeProductRepository $themeProductRepository)

    {
        $this->shops = $shops;
        $this->themeProductRepository = $themeProductRepository;
    }


    public function dhumketuHome($shop,$key) {

        $products = $this->themeBannerRepository->getProducts($shop,$key,$condition='subCategory_id',$limit=20,$textSearch=false);

        dd($products);


        return View::make('themes.theme_2_dhumketuTheme.home.home', compact('products'));
    }

    public function dhumketuProduct() {
        return View::make('themes.theme_2_dhumketuTheme.product.product');
    }

    public function getProduct() {
//        $shop = $this->shops->getBySlug($slug);
        return View::make('themes.theme_2_dhumketuTheme.product.product');
    }

}