<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 4/5/2015
 * Time: 5:09 PM
 */
use Chorki\Carts\Models\CartRepositoryInterface;
use Chorki\shops\Models\ShopRepositoryInterface as Shop;
use Chorki\products\Models\ProductRepositoryInterface as Product;
// use Mail;

class StaticPageController extends \BaseController{

    protected $shops,$products;
    /**
     * @var CartRepositoryInterface
     */
    public $cart;

    function __construct(Shop $shops,CartRepositoryInterface $cart, Product $products)
    {
        $this->shops = $shops;
        $this->cart = $cart;
        $this->products= $products;
    }


     public function getStarted(){
        $cartCount = $this->cart->cartCount();
        $cartContents = $this->cart->cartContent();
        $cartTotal = $this->cart->cartTotal();
        $cart = View::make('_partials.cart',compact('cartCount','cartContents','cartTotal'));
        return View::make('public.shop._partials.info',compact('cart'));
    }

    public function getTerms(){
        $cartCount = $this->cart->cartCount();
        $cartContents = $this->cart->cartContent();
        $cartTotal = $this->cart->cartTotal();
        $cart = View::make('_partials.cart',compact('cartCount','cartContents','cartTotal'));
        return View::make('public.shop._partials.term',compact('cart'));
    }
    public function getPrivacies(){
        $cartCount = $this->cart->cartCount();
        $cartContents = $this->cart->cartContent();
        $cartTotal = $this->cart->cartTotal();
        $cart = View::make('_partials.cart',compact('cartCount','cartContents','cartTotal'));
        return View::make('public.shop._partials.privacy',compact('cart'));
    }

    public function getFeatures(){
        $cartCount = $this->cart->cartCount();
        $cartContents = $this->cart->cartContent();
        $cartTotal = $this->cart->cartTotal();
        $cart = View::make('_partials.cart',compact('cartCount','cartContents','cartTotal'));
        return View::make('public.shop._partials.features',compact('cart'));
    }

    public function getAboutUs(){
        $cartCount = $this->cart->cartCount();
        $cartContents = $this->cart->cartContent();
        $cartTotal = $this->cart->cartTotal();
        $cart = View::make('_partials.cart',compact('cartCount','cartContents','cartTotal'));
        return View::make('public.shop._partials.aboutus',compact('cart'));
    }
    public function getFAQ(){
        $cartCount = $this->cart->cartCount();
        $cartContents = $this->cart->cartContent();
        $cartTotal = $this->cart->cartTotal();
        $cart = View::make('_partials.cart',compact('cartCount','cartContents','cartTotal'));
        return View::make('public.shop._partials.faq',compact('cart'));
    }
    public function getPricing(){
        if (!empty(Input::get())) {
            Session::put('shopCreateData', Input::get());
        }
        $cartCount = $this->cart->cartCount();
        $cartContents = $this->cart->cartContent();
        $cartTotal = $this->cart->cartTotal();
        $cart = View::make('_partials.cart',compact('cartCount','cartContents','cartTotal'));
        return View::make('public.shop._partials.pricing',compact('cart'));
    }
    public function getFshop(){
        $cartCount = $this->cart->cartCount();
        $cartContents = $this->cart->cartContent();
        $cartTotal = $this->cart->cartTotal();
        $cart = View::make('_partials.cart',compact('cartCount','cartContents','cartTotal'));
        return View::make('public.shop._partials.fshop',compact('cart'));
    }
    public function contactUsAjax()
    {
        $data = [ 'msg' => Input::get()['form']];
        Mail::queue('emails.contact', $data, function($message) use ($data)
        {
            $message->to('info@ghoori.com.bd', 'Ghoori')->subject('New query submitted');
        });
        return json_encode(array("success"=>true));
    }

    public function photographyPackage() {
        if(Auth::user() && Auth::user()->shop){
            $shop = Auth::user()->shop;
        }
        else {
            $shop = null;
        }
        
        return View::make('public.shop.photography')->withShop($shop);
    }

}