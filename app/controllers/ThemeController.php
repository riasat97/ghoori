<?php

use Chorki\Carts\Models\CartRepositoryInterface;
use Chorki\shops\Models\ShopRepositoryInterface;
use Chorki\themes\banners\ThemeBannerRepository;
use Chorki\themes\products\ThemeProductRepository;
use Chorki\Traits\CartTrait;

class ThemeController extends \BaseController {
    use CartTrait;
    protected $themeBannerRepository;
    protected $shop;
    protected $themeProductRepository;
    protected $cart;

    function __construct (ThemeBannerRepository $themeBannerRepository,ThemeProductRepository $themeProductRepository,
                          ShopRepositoryInterface $shop,CartRepositoryInterface $cart)
    {
        $this->themeBannerRepository = $themeBannerRepository;
        $this->shop = $shop;
        $this->themeProductRepository = $themeProductRepository;
        $this->cart = $cart;
    }

    public function getUploadBanner($slug, $theme) {

        $shop = $this->shop->getBySlug($slug);
        $shop->load('themeBanners');
        //  dd($shop->themeBanners->count());

        $img_directory = public_path('public_img').'/shop_'.$shop->id.'/theme/banners';
        $thumb_directory = $img_directory.'/thumb';
        $tmp_img_directory = public_path('img_tmp');
        $tmp_thumb_directory = $tmp_img_directory.'/thumb';

        $images = null;
        foreach($shop->themeBanners as $image){
            if($shop->themeBanners->count()){
                $imageLink = $image->name;
                copy($img_directory.'/'.$imageLink,$tmp_img_directory.'/'.$imageLink);
                copy($thumb_directory.'/'.$imageLink,$tmp_thumb_directory.'/'.$imageLink);
                $images[] = $imageLink;
            }
        }
        if($shop->id == Session::get('shop_id'))
        {
            return View::make('themes.theme_1._partials.bannerUpload', compact('shop', 'images'));

        }

    }
    public function postUploadBanner(){
        $shopId= Input::get('shop_id');
        $images = Input::get('images');
        $shop= $this->shop->getById($shopId);

        if($shop->themeBanners->count()){
            $oldImages = array();
            foreach($shop->themeBanners as $image){

                $imageLink = $image->name;
                $oldImages[] = $imageLink;
            }

            $images = array_diff(Input::get('images'),$oldImages);
            $deleted_images = array_diff($oldImages,Input::get('images'));//@todo delete these

            foreach($deleted_images as $deletee){
                ThemeBanner::where('name',$deletee)->delete();
            }
        }
        $this->themeBannerRepository->moveAndRecordImages($images,$shopId);
        return Redirect::back();

    }

	public function getProductsByCategory($slug,$category){

        $products=$this->themeProductRepository->getProductsByCategory($slug,$category);
        $subCategory = (!empty(Input::get('sub-category')))?Input::get('sub-category'):null;
        $shop= $this->shop->getBySlug($slug);
        $parameters = compact('shop','products','category','subCategory','categories',
            'latestProducts','popularProducts','cart');

        if($shop->theme && $shop->theme->name == 'dhumketu'){

            return View::make($shop->theme->path.'.home.home',
                $parameters);
        }
        return View::make('themes.theme_1.category.category', $parameters);
    }
    public function getSearchProductsByCategory($slug){
        $shop= $this->shop->getBySlug($slug);
        $products=$this->themeProductRepository->getSearchProductsByCategory($slug);
        $category=$products['category'];
//        dd($products);
        $products=$products['products'];

        Input::flash();

        if($shop->theme && $shop->theme->name == 'dhumketu'){

            return View::make('themes.theme_2.home.home',
                compact('shop','products','category','categories','latestProducts','popularProducts','cart'));
        }

        if($shop->theme && $shop->theme->name == 'chayaneer'){

            return View::make('themes.theme_3_chayaneer.home.home',
                compact('shop','products','category','categories','latestProducts','popularProducts','cart'));
        }

//        $products=$this->themeProductRepository->getSearchProductsByCategory($slug);
//        $category=$products['category'];
//        $shop= $this->shop->getBySlug($slug);
//        $products=$products['products'];

//        Input::flash();

        return View::make('themes.theme_1.category.category',
            compact('shop','products','category','categories','latestProducts','popularProducts','cart'));
    }

}
