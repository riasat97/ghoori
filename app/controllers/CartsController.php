<?php
use Chorki\Carts\Models\CartRepositoryInterface;
use Chorki\products\Models\ProductRepositoryInterface as Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartsController extends \BaseController {

    public $product;
    public $cart;
    private $attribute;


    public function __construct(Product $product,CartRepositoryInterface $cart,Attribute $attribute)
    {
        $this->product = $product;
        $this->cart = $cart;
        $this->attribute = $attribute;
    }
    public function index()
    {
        // return (json_encode(Input::all()));
        $cartCount = $this->cart->cartCount();
        $cartContents = $this->cart->cartContent();
        $cartTotal = $this->cart->cartTotal();
        $cartObjects = json_decode($cartContents);
        $shops = $this->getAllUniqueShops($cartObjects);
        $carts = array();
        $cartsTotal=0;
        $cartsTotalWithDiscount=0;
        $shopTotal = $shopTotalWithDiscount =  array();
        //dd($cartContents->toArray());
        foreach ($shops as $shop) {
            foreach ($cartObjects as $cartRow) {
                if ($shop == $cartRow->options->shop_id)
                {
                    // var_dump($cartRow->options->discount);
                    $carts[$shop][] =  $cartRow;
                    $shopTotal[$shop]=$cartsTotal+=$cartRow->subtotal;
                    $shopTotalWithDiscount[$shop]=$cartsTotalWithDiscount+=$cartRow->options->discount * $cartRow->qty;
                    $shopTitles[$shop]=$cartRow->options->shop_title;
                }
            }
            $cartsTotal=$cartsTotalWithDiscount=0;
        }
       // dd();
       // $cart = View::make('_partials.cart',compact('cartCount','cartContents','cartTotal'));
        return View::make('carts.index',compact('carts','shopTotal','shopTitles','cart', 'shopTotalWithDiscount'));
    }

    private function getAllUniqueShops($objects) {
        $shops = array();

        foreach($objects as $obj){
            $shop_id = $obj->options->shop_id;
            if (!in_array($shop_id, $shops)) {
                array_push($shops, $shop_id);
            }
        }

        return $shops;
    }
    public function create()
    {

    }
    public function store()
    {
        $exists=false;
        $qty=0;
        // return (json_encode(Input::all()));
        header("content-type : application/javascript");
        $input = Input::all();
        $product = $this->product->getById($input['product_id']);
        $product->load('shop','images','campaigns');
        $cartContents = $this->cart->cartContent();
        foreach($cartContents as $cartContent){
          /* var_dump($cartContent->id);
           var_dump($input['product_id']);
           echo '---';*/
            if($cartContent->id == $input['product_id']){
                $qty += $cartContent->qty;

                if(($product->stock-$qty) >= $input['qty'] ){

                   $exists =true;
               }
                else{
                    return $_GET['callback'].'('.json_encode(['success'=>false,
                         'status' => 'Invalid Quantity'
                    ]).')';
                }
            }
        }
        if($exists){
            $result=$this->addToCart($input,$product);
            if($result){
            $cartCount = $this->cart->cartCount();
            $cartTotal = $this->cart->cartTotal();
            $getCart = $this->cart->cartGet($cartContent->rowid);
            return $_GET['callback'].'('.json_encode(['success'=>true,
                'cart'=> $getCart,'count'=>$cartCount,'total'=>$cartTotal, 'status' =>'exists'
            ]).')';
            }
        }
        $result=$this->addToCart($input,$product);
        if($result) {
            $cartCount = $this->cart->cartCount();
            $cartTotal = $this->cart->cartTotal();
            $getCarts = $this->cart->cartContent();
            foreach ($getCarts as $cartContent) {

                if ($cartContent->id == $input['product_id']) {
                    $finalCart = $cartContent;
                }
            }
            return $_GET['callback'].'('.json_encode(['success' => true,
                                        'cart' => $finalCart, 'count' => $cartCount, 'total' => $cartTotal, 'status' => 'new'
                                    ]).')';
            
        }
        else{

            return $_GET['callback'].'('.json_encode(['success'=>false,
                'status' => 'invalid quantity'
            ]).')';
        }

    }
    public function show($id)
    {

    }
    public function edit($id)
    {

    }
    public function updateCart()
    {
      $input= Input::all();
      foreach($input['rowid'] as $key => $cartItem)  {
      $stock=$input['stock'][$key];
      if($stock>= $input['qty'][$key]){
      $this->cart->cartUpdate($cartItem,array('qty' => $input['qty'][$key]));
      }else{
      return Redirect::route('carts.index')->with('flash_message', '<b>Invalid quantity!</b> ')
          ->with('flash_type', 'alert-danger');
      }
      }
      return Redirect::route('carts.index') ->with('flash_message', '<b>Well done!</b>  successfully updated .')
          ->with('flash_type', 'alert-success');
    }

    public function delete($rowId){

    $this->cart->cartRemove($rowId);
    return Redirect::route('carts.index');

    }
    public function remove(){
        header("content-type : application/javascript");
         $rowId = Input::get('rowid');
         $this->cart->cartRemove($rowId);
        return $_GET['callback'].'('.json_encode(['success'=>true,
            'rowid'=> $rowId,'count'=>$this->cart->cartCount(),'total'=>$this->cart->cartTotal()
        ]).')';
    }

    private function addToCart($input, $product)
    {
      if($product->stock >= $input['qty']){
       $color= $this->getColorIfExists(Input::get('color'));
       $size= $this->getSizeIfExists(Input::get('size'));
        if(!$color && !$size){
            $this->addTo($input,$product);
        }
        elseif($color && $size){
            $this->addTo($input,$product,$color,$size);
        }
        elseif($color && !$size){
            $this->addTo($input,$product,$color);
        }
        elseif($size && !$color){
            $this->addTo($input,$product,$color=null,$size);
        }
        $this->cart->save($input);
        return true;
      }
      else{
        return false;
      }
    }
    private function getProductAttribute($input){
        return $this->attribute->getProductAttribute($input);
    }
    private function getColorIfExists($colorId){
        if($colorId != null){
           return $color=$this->getProductAttribute($colorId);
        }
        else{
           return $color=null;
        }
    }
    private function getSizeIfExists($sizeId){
        if($sizeId != null){
           return $size= $this->getProductAttribute($sizeId);
        }else{
           return $size=null;
        }
    }
    private function addTo($input,$product,$color=null,$size=null){
        //$discountedPrice=$this->checkIfProductHasGpCampaign($product);
        $discountedPrice = $product->price - $product->getDiscountAmmount();
        $discountRate = $product->getDiscountRate();

        $this->cart->cartAdd(array('id' => $product->id, 'name' => $product->name,
            'qty' => $input['qty'],
            'price' => $product->price,
            'options' => array('image' => $product->images[0]['imageLink'],
                'shop_title' => $product->shop->title,
                'shop_id' => $product->shop_id,
                'shop' => $product->shop,
                'product' => $product,
                'color'=>$color,
                'size'=>$size,
                'discount'=>$discountedPrice,
                'discountrate'=>$discountRate
            )));
    }
    public function getBuyNow(){
        $exists=false;
        $qty=0;
        $input = Input::all();
        $product = $this->product->getById($input['product_id']);
        $product->load('shop','images','campaigns');
        $cartContents = $this->cart->cartContent();
        foreach($cartContents as $cartContent){

            if($cartContent->id == $input['product_id']){
                $qty += $cartContent->qty;
                if(($product->stock-$qty) >= $input['qty']){

                 $exists = true;
                }
                else{
                    $url = $this->getProductUrl($product);
                    return  Redirect::to($url)->with('flash_message', '<b>Invalid quantity!</b> ')
                        ->with('flash_type', 'alert-danger');
                }
            }
        }
        if($exists){
            $result=$this->addToCart($input,$product);
            if($result){

                return  Redirect::route('carts.index')
                    ->with('flash_message','<b>Well done!</b>  successfully updated .')
                    ->with('flash_type', 'alert-success');
            }
        }
        $result=$this->addToCart($input,$product);
        if($result) {

            return  Redirect::route('carts.index')
                ->with('flash_message','<b>Well done!</b>  successfully added .')
                ->with('flash_type', 'alert-success');
        }
        else{
            $url = $this->getProductUrl($product);
            return  Redirect::to($url)->with('flash_message', '<b>Invalid quantity!</b> ')
                ->with('flash_type', 'alert-danger');
        }
    }
    private function checkIfProductHasGpCampaign($product)
    {
        if(productHasGpCampaign($product->id)){
            return productHasGpCampaign($product->id);
        }else{
            return $product->price;
        }
    }
    private function getProductUrl($product){
        return GhooriURI::producturl($product->shop->subDomain, URL::route('products.view',
            array($product->shop->getSlug(),$product->id)),$product->id) ;
    }

}
