<?php

use Chorki\Carts\Models\CartRepositoryInterface;
use Chorki\Orders\Models\OrderRepositoryInterface;
use Chorki\products\Models\ProductRepositoryInterface;
use Chorki\Shippings\ShippingAddresses\Models\ShippingRepositoryInterface;

use Chorki\shops\Models\ShopRepositoryInterface;

use Illuminate\Support\Facades\DB;
use Log as Log;
use Chorki\ProductEvents\ProductEvent;

/**
* 
*/
class CampaignController extends \BaseController
{

    public $shop;
    private $product;
    protected $winterIsHereRepository;

    protected $productEvent;


    public function __construct(ShopRepositoryInterface $shop,
                                ProductRepositoryInterface $product,
                                \Chorki\WinterIsHereRepository $winterIsHereRepository,ProductEvent $productEvent) {

        $this->shop = $shop;
        $this->product = $product;
        $this->winterIsHereRepository = $winterIsHereRepository;
        
        $this->productEvent = $productEvent;
    }

    public function addGPCampaignToProduct($slug) {
        $slugShop = $this->shop->getBySlug($slug);
        if(!$slugShop){
            //@todo redirect to 404
        }
        $shop = $this->shop->_getShop();
        if((!$shop)||($slugShop->id === $shop->id)){
            $product=$this->product->getById( Input::get('product_id') );
            $gp10 = 1;
            $gp15 = 2;
            //dd(Input::all());

            if(Input::get('discount')=='1'){
                $campaignId = $gp10;
            }else if(Input::get('discount')=='2'){
                $campaignId = $gp15;
            }else{
                $campaignId = -1;
            }

            if($campaignId>0){
                $product->campaigns()->sync([$campaignId]);
                return Redirect::back()
                    ->with('flash_message', 'Your product has been added to the campaign. Thank you.')
                    ->with('flash_type', 'alert-success');
            }else{
                $product->campaigns()->sync([]);
                return Redirect::back()
                    ->with('flash_message', 'Your product has been removed from the campaign. Thank you.')
                    ->with('flash_type', 'alert-success');
            }
        }
        else
        App::abort(403, 'Unauthorized action.');
    }

    public function addGPCampaignToAllProductsForMyShop($slug) {
        $slugShop = $this->shop->getBySlug($slug);
        if(!$slugShop){
            //@todo redirect to 404
        }
        $shop = $this->shop->_getShop();
        $shop->campaigns()->sync([1]);
        if((!$shop)||($slugShop->id === $shop->id)){
            foreach ($shop->products as $key => $product) {
                $product->campaigns()->sync(['1']);
            }
            return Redirect::back()
                    ->with('flash_message', 'All of your products have been added to the campaign. Thank you.')
                    ->with('flash_type', 'alert-success');
        }
        else
            App::abort(403, 'Unauthorized action.');
        
    }
    public function postAddWinterIsHereCampaignToProduct(){
        $productId=Input::get('product_id');
        $shop= $this->shop->_getShop();
        $product=$this->product->getById($productId);
        $winterIsHereExists=$product->winterIsHereCampaigns->count();
        if(!$winterIsHereExists && Input::get('discount')=='0'){
            return Redirect::back()
                ->with('flash_message', 'Select a discount plan first ')
                ->with('flash_type', 'alert-danger');
        }
        if(!$winterIsHereExists){
        $this->winterIsHereRepository->save($product);
        }
        else{
        $this->winterIsHereRepository->update($product);
        }

        $this->productEvent->postProduct($shop,$product,true);

        $wih15 = 2;
        $wih20 = 3;
        $wih30 = 4;
        $wih40 = 5;
        $wih50 = 6;
        $wih5  = 8;
        $wih26  = 9;
        $wih10  = 10;


        if(Input::get('discount')=='5'){
            $campaignId = $wih5;
        }else if(Input::get('discount')=='10'){
            $campaignId = $wih10;
        }else if(Input::get('discount')=='15'){
            $campaignId = $wih15;
        }else if(Input::get('discount')=='20'){
            $campaignId = $wih20;
        }else if(Input::get('discount')=='26'){
            $campaignId = $wih26;
        }else if(Input::get('discount')=='30'){
            $campaignId = $wih30;
        }else if(Input::get('discount')=='40'){
            $campaignId = $wih40;
        }else if(Input::get('discount')=='50'){
            $campaignId = $wih50;
        }else{
            $campaignId = -1;
        }

        if($campaignId>0){
            $product->campaigns()->sync([$campaignId]);
            return Redirect::back()
                ->with('flash_message', 'Your product has been added to the campaign. Thank you.')
                ->with('flash_type', 'alert-success');
        }else{
            $product->campaigns()->sync([]);
            return Redirect::back()
                ->with('flash_message', 'Your product has been removed from the campaign. Thank you.')
                ->with('flash_type', 'alert-success');
        }
    }
}




