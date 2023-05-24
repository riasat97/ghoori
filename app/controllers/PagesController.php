<?php
use Chorki\shops\Models\ShopRepositoryInterface as Shop;
class PagesController extends \BaseController {

    function __construct(Shop $shop)
    {
        $this->shop = $shop;

    }

	public function index()
	{
		//
	}

    public function postAbout(){
      $shop = $this->shop->_getShop();
      $shop->description = Input::get('description');
      $shop->update();
      return Redirect::route('about.show',$shop->getSlug());
    }
    public function showAbout($slug){
        $shop = $this->shop->getBySlug($slug);
        return View::make('pages.show.about',compact('shop'));
    }
    public function postPrivacy(){

        $shop = $this->shop->_getShop();
        $content = Input::get('content');
        $shopPrivacy = $shop->shopPrivacy;
        if($shopPrivacy){
        $this->_saveContent($shopPrivacy,$content,$shop,'shopPrivacy');
        }
        else{
        $shopPrivacy = new ShopPrivacy();
        $this->_saveContent($shopPrivacy,$content,$shop,'shopPrivacy');
        }
        return Redirect::route('privacy.show',$shop->getSlug());
    }

    public function showPrivacy($slug){
        /*$shop = $this->shop->getBySlugWithModelAndType($slug,'shopContent');*/
        $shop = $this->shop->getBySlug($slug);
        $shop->load('shopPrivacy');
        return View::make('pages.show.privacy',compact('shop'));
    }
    public function postTerm(){

        $shop = $this->shop->_getShop();
        $content = Input::get('content');
        $shopTerm = $shop->shopTerm;
        if($shopTerm){
            $this->_saveContent($shopTerm,$content,$shop,'shopTerm');
        }
        else{
            $shopTerm = new ShopTerm();
            $this->_saveContent($shopTerm,$content,$shop,'shopTerm');
        }
        return Redirect::route('term.show',$shop->getSlug());
    }
    public function showTerm($slug){
        $shop = $this->shop->getBySlug($slug);
        $shop->load('shopTerm');
        return View::make('pages.show.term',compact('shop'));
    }
    private function _saveContent($model,$content,$shop,$function){
        $model->content = $content;
        $shop->$function()->save($model);
    }

}
