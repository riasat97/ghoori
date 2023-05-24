<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 5/17/2015
 * Time: 7:38 PM
 */
namespace Chorki\Orders\Models;

use Carbon\Carbon;
use Chorki\Carts\Models\CartRepositoryInterface;
use Chorki\GeneralStatusRepository;
use Chorki\ProductEvents\ProductEvent;
use Chorki\products\Models\ProductRepositoryInterface;
use Chorki\Repositories\DbRepositories;
use Chorki\Shippings\ShippingAddresses\Models\ShippingAddress;
use Chorki\ShippingSDK\ECourier;
use Chorki\shops\Models\ShopRepositoryInterface;
use Chorki\SMS\SMSSender;
use Chorki\Traits\reports\CouponTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Log as Log;

class OrderRepository extends DbRepositories implements OrderRepositoryInterface{

    use CouponTrait;
    public $shippingAddress;
    public $cart;
    private $paymentMethod;
    private $productRepo;
    private $shop;
    private $ecourier;
    private $ecourierRegistration;
    private $generalStatusRepository;
    private $code;
    protected $SMSSender;
    protected $message;
    protected $productEvent;

    function __construct(Order $model,ShippingAddress $shippingAddress,
                         CartRepositoryInterface $cart,\PaymentMethod $paymentMethod,
                         ProductRepositoryInterface $productRepo,ShopRepositoryInterface $shop,
                         ECourier $ecourier,\EcourierRegistration $ecourierRegistration,
                         GeneralStatusRepository $generalStatusRepository,\VerificationCode $code,
                         SMSSender $SMSSender,ProductEvent $productEvent)
    {
        $this->model = $model;
        $this->shippingAddress = $shippingAddress;
        $this->cart = $cart;
        $this->paymentMethod = $paymentMethod;
        $this->productRepo = $productRepo;
        $this->shop = $shop;
        $this->ecourier = $ecourier;
        $this->ecourierRegistration = $ecourierRegistration;
        $this->generalStatusRepository = $generalStatusRepository;
        $this->code = $code;
        $this->SMSSender = $SMSSender;
        $this->productEvent = $productEvent;
    }

    public function save(array $input){
        DB::beginTransaction();

        try{
            $order= $this->createOrder($input);
            $shippingAddress=$this->postShippingAddress($input,$order);
            $this->postVerificationCodeForShippingAddress($order,$shippingAddress);
            $this->insertOrderedProductsToDatabase($order,$input['shop_id']);

            if (!empty($input['cuponText'])) {
                $cuponDiscount = $this->getCuponDiscount($input,$order->subtotal);
            }
            else
                $cuponDiscount = 0;

            $order->couponDiscount = $cuponDiscount;
            $order->subtotal = $order->subtotal - $cuponDiscount;

            if ($input['shippingLocation_id'] != 1 && !empty($input['shippingPackage_id']) && $input['paymentMethod_id'] == 1 ) {
                $order->codCharge = ceil($order->subtotal/1000)*10;
            }
            else {
                $order->codCharge = 0;
            }
            $order->total = $order->subtotal + $order->shippingCharge + $order->codCharge;

            $order->status = array_get($input,'status','New');
            $order->update();
            $this->postGeneralOrderStatus($order);
        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return $order;
    }

    public function getByTransactionId($transactionId){
        return $this->model->where('transaction_id',$transactionId)->get()->first();
    }

    private function createOrder($input){
        $totalOrderWeight=$this->getTotalWeightByShop($input['shop_id']);
        $shippingCost = $this->getShippingCost($input,$totalOrderWeight);
        $order= $this->model->create(
            array(
                'shippingPackage_id'=> array_get($input,'shippingPackage_id',null),
                'paymentMethod_id'=>$input['paymentMethod_id'],
                'shippingLocation_id'=>$input['shippingLocation_id'],
                'user_id'=>Auth::user()->id,
                'shop_id'=>$input['shop_id'],
                'total'=> 0.0,
                'status' => $input['status'],
                'shippingWeight_id'=> array_get($input,'shippingWeight_id',''),
                'shippingCharge'=>$shippingCost,
                'totalOrderWeight'=>$totalOrderWeight,
                'transaction_id' => array_get($input,'transaction_id')
           )
        );
        return $order;
    }
    private function postShippingAddress($input,$order){
        $shippingTo= array('name'=>$input['name'],'email'=>$input['email'],'mobile'=>$input['mobile'],
            'address'=>$input['address'],'user_id'=>Auth::user()->id,
            'postcode'=>$input['postcode'],'order_id'=>$order->id);
       return $shippingAddressSaved =$this->shippingAddress->create($shippingTo);
    }
    public function getShippingCharge($shippingLocation_id,$shippingPackage_id,$shippingWeight_id){

        $results = DB::select( DB::raw("
                    SELECT
		            SWC.`unitCost`
                    FROM shippingpackage_shippinglocation AS SPL
                    JOIN `shippingweightcharges` AS SWC ON SWC.`shippingpackage_shippinglocation_id` = SPL.`id` AND SWC.`shippingWeight_id` = $shippingWeight_id
                    WHERE  SPL.`shippingLocation_id` = $shippingLocation_id AND SPL.`shippingPackage_id`=$shippingPackage_id"
        ) );
        return $results[0]->unitCost;
    }
    public function getShippingCost($input,$totalOrderWeight){
        if(!Input::get('shippingPackage_id')){//@todo don't use Input facade
          return $shippingCharge = $this->shop->getShopShippingChargeByLocation($input['shippingLocation_id']
               ,$totalOrderWeight,$input['shop_id']
               );
        }
        else {
            return $shippingCharge = $this->getShippingCharge($input['shippingLocation_id'], $input['shippingPackage_id'], $input['shippingWeight_id']);
        }
    }
    public function getOrderByShop($shopId){
        return $this->model->where('shop_id','=',$shopId)->whereIn('status',array('Proceed', 'New', 'Reject', 'Complete'))->orderBy('orders.created_at', 'desc')->get();
    }

    public function getNewOrderCountByShop($shopId){
        return $this->model->where('shop_id','=',$shopId)->where('orders.status', '=', 'New')->count();
    }

    public function removeItemsFromCart($shopId) //@todo has been moved to controller
    {
        foreach ($this->cart->cartContent() as $item) {
            if($shopId == $item->options->shop_id){
                $removedItem= $this->cart->cartRemove($item->rowid);
            }
        }
        return $removedItem;
    }

    public function restoreOrderProducts($order_id){
        DB::beginTransaction();
        try{
            $order = $this->getById($order_id);
            foreach($order->products as $orderedProduct){
                $product= $this->productRepo->getById($orderedProduct->pivot->product_id);
                $restoreQty= $product->stock+$orderedProduct->pivot->quantity;
                $product->stock=$restoreQty;
                $product->update();
                $this->productEvent->postProductDependsOnStock($product);
            }
        }catch(Exception $e){
            DB::rollback();
            throw new Exception("FATAL ERROR!! Error While Removing products from order: $order_id");
        }
        DB::commit();
    }

    private function insertOrderedProductsToDatabase($order,$shopId)
    {
        $orderId = $order->id;
        $products=[];
        $subtotal = 0;
        foreach ($this->cart->cartContent() as $cartRow) {
            if($shopId == $cartRow->options->shop_id){
                $color= $this->getColor($cartRow);
                $size= $this->getSize($cartRow);
                $product=$this->productRepo->getById($cartRow->id);
                $discount = 0.0;
                $discountComment = '';
                $productDoesNotHaveActiveCampaign = true;
                if(!$product->campaigns->isEmpty()){//Active campaign discount will get precedence
                    if($product->campaigns->first()->active){
                        $productDoesNotHaveActiveCampaign = false;
                        $discounterClass = "\\Chorki\\Campaigns\\".$product->campaigns->first()->className;
                        $discounter = new $discounterClass();
                        $discount = $discounter->calculateDiscount($orderId , $cartRow->id, $cartRow->price, $cartRow->qty);
                        $discountComment = $discounter->getDiscountComment();
                    }
                }
                if($productDoesNotHaveActiveCampaign && $product->merchant_discount && $product->merchant_discount>0.001){
                    $discount = $cartRow->subtotal*$product->merchant_discount/100;
                    $discountComment = $product->merchant_discount.'%';
                }
                $lineTotal = $cartRow->subtotal-$discount;
                $subtotal+=$lineTotal;
                $products=DB::table('order_product')->insert(
                    array(
                        'order_id'=>$orderId,
                        'product_id'=>$cartRow->id,
                        'quantity' => $cartRow->qty,
                        'price' => $cartRow->price,
                        'lineTotal'=>$lineTotal,
                        'discount' => $discount,
                        'discountComment' => $discountComment,
                        'size' => $size,
                        'color'=>$color,
                        'productName'=>$product->name //@todo should be saved in the cart
                    )
                );
                $product->stock = $product->stock-$cartRow->qty; //@todo should check before deducting
                $product->update();
                $this->productEvent->postProductDependsOnStock($product);
            }
        }
        $order->subtotal = $subtotal;
        return $products;
    }

    public function isSessionExpired($shopId)
    {
       //  $a=$this->cart->cartContent();
       // dd($a->toArray());
        $foundShop = false;
        foreach ($this->cart->cartContent() as $item) {
            if($shopId === $item->options->shop_id && !empty($item)){
                $foundShop = true;
                break;
            }
            else{
                $foundShop = false;
            }
        }
        return !$foundShop;
    }

    private function getColor($item)
    {
        if($item->options->color){
           return $color= $item->options->color->value;
        }
        else{
           return $color=null;
        }
    }
    private function getSize($item)
    {
        if($item->options->size){
            return $size= $item->options->size->value;
        }
        else{
            return $size=null;
        }
    }

    public function getShippingPackagesByLocation($shippingLocation_id,$totalOrderWeight,$shopId)
    {
        return  $results = DB::select( DB::raw("
     SELECT
	 SP.`id`
	 , SP.`shippingChannel_id`
	 , SC.name
	 , SP.`label`
	 , SWC.`unitCost`
	 , SWC.`shippingWeight_id`
	 , SW.`max`
	 , SW.`min`
FROM shops
JOIN shippingchannel_shop AS sh_s ON  sh_s.`shop_id`=shops.`id`
JOIN shippingchannels AS SC ON sh_s.`shippingChannel_id`=SC.`id`
JOIN `shippingweights` AS SW ON SW.`shippingChannel_id`= SC.`id`
JOIN `shippingpackages` AS SP ON SP.`shippingChannel_id` = SC.`id`
JOIN `shippingpackage_shippinglocation` AS SPL ON SPL.`shippingPackage_id` = SP.`id`
JOIN `shippingweightcharges` AS SWC ON SWC.`shippingpackage_shippinglocation_id`= SPL.`id` AND SWC.`shippingWeight_id`= SW.`id`
WHERE shops.`id` = $shopId AND SPL.`shippingLocation_id` = $shippingLocation_id  AND SW.`max` >= $totalOrderWeight AND SW.`min` <= $totalOrderWeight ORDER BY SP.`shippingChannel_id` "
        ) );

    }


    public function getTotalWeightByOrder($orderId)
    {
       $order=$this->getById($orderId);
       $weight=0;
       foreach($order->products as $product){
           $weight+=$product->weight*$product->pivot->quantity;
       }
        return $totalWeight=ceil($weight);
    }
    public function getTotalWeightByShop($shopId){
        $cartContents = $this->cart->cartContent();
        $cartObjects = json_decode($cartContents);
        $totalOrderWeight=0;
        foreach($cartObjects as $cartRow){
            if($cartRow->options->shop_id == $shopId){
                $totalOrderWeight+= ceil($cartRow->options->product->weight*$cartRow->qty);
            }
        }
        return $totalOrderWeight;
    }
    public function getCartSubtotalByShop($shopId){
        $cartContents = $this->cart->cartContent();
        $cartObjects = json_decode($cartContents);
        $cartSubtotal=0;
        foreach($cartObjects as $cartRow){
            if($cartRow->options->shop_id == $shopId){
                $cartSubtotal+=$cartRow->subtotal;
            }
        }
        return $cartSubtotal;
    }


    public function postOrderToCourierService($order, $shop)
    {
        if($order->shippingPackage){
            if($order->shippingPackage->shippingChannel->name == 'ecourier'){
                $apiInfo=$this->ecourierRegistration->getRequiredApiInfo($shop);
                $this->ecourier->setAPI($apiInfo['user_id'],$apiInfo['user_name'],$apiInfo['api_key'],$apiInfo['api_secret']);
                $parcel=$this->ecourier->insertParcel($order);
                return $parcel;
            }
            else {
                return false;
            }
        }
        else{
            
            $response = array('method'=>"own order",'status'=>true);
            $response = (object) $response;
            return $response;
        }
    }

    public function getParcelInquiry($parcelId,$shopId)
    {
        $shop=$this->shop->getById($shopId);
        $apiInfo=$this->ecourierRegistration->getRequiredApiInfo($shop);
        $this->ecourier->setAPI($apiInfo['user_id'],$apiInfo['user_name'],$apiInfo['api_key'],$apiInfo['api_secret']);
        $parcel=$this->ecourier->parcelInquiry($parcelId);
        return $parcel;
    }

    public function getOrderByUser()
    {
        $userId=Auth::user()->id;
        $myOrders=$this->model->where('user_id','=',$userId)->whereIn('status',array('Proceed', 'New', 'Reject',
                 'Complete', 'PaymentFailed','Unverified'))->orderBy('created_at','desc')->get();
        return $myOrders;
    }

    public function getCartDiscountedSubtotalByShop($shopId)
    {
        $cartContents = $this->cart->cartContent();
        $cartObjects = json_decode($cartContents);
        $cartDiscountedSubtotal=0;
        foreach($cartObjects as $cartRow){
            if($cartRow->options->shop_id == $shopId){
                $cartDiscountedSubtotal+=$cartRow->qty*$cartRow->options->discount;
            }
        }
        return $cartDiscountedSubtotal;
    }

    public function postParcelCancel($parcelId, $shopId)
    {
        $shop=$this->shop->getById($shopId);
        $apiInfo=$this->ecourierRegistration->getRequiredApiInfo($shop);
        $this->ecourier->setAPI($apiInfo['user_id'],$apiInfo['user_name'],$apiInfo['api_key'],$apiInfo['api_secret']);
        $parcel=$this->ecourier->parcelCancel($parcelId);
        return $parcel;
    }
    public function getLatestStatusByTimeIndex($statuses, $keyToSearch)
    {
        $currentMax = '0000-00-00 00:00:00';
        foreach($statuses as $key => $item)
        {
            if ( strtotime($item[$keyToSearch]) > strtotime($currentMax) ) {
                $currentMax = $item[$keyToSearch];
                $status =  $item[0];
            }
        }
        return ['time'=>$currentMax ,'status'=>$status];
    }
    public function postLatestStatus($order, $latestStatus)
    {
        $order->parcelStatus =$latestStatus['status'].'@'.$latestStatus['time'];
        $order->save();
    }

    public function postGeneralOrderStatus($order)
    {
        $this->generalStatusRepository->logGeneralOrderStatus($order);
    }

    public function getCheckStockAgainWhileOrderProceed($shopId)
    {
        $products=[];
        $cartContents=$this->cart->cartContent();
        $cartContents=json_decode($cartContents);
        // dd($cartContents->toArray());
        foreach ($cartContents as $cartContent) {
            if($cartContent->options->shop->id == $shopId){
                $product=$this->productRepo->getById($cartContent->id);
                $stock=$product->stock;
                $qty=$cartContent->qty;
                if($stock>=$qty)
                    $products[0]=true;
                else{
                    $products[0]=false;
                    $products[$cartContent->name]=['stock'=>$stock,'qty'=>$qty];
                }
            }
        }
        return $products;

    }

    private function postVerificationCodeForShippingAddress($order,$shippingAddress)
    {
       $status= $order->status;
       if($status == 'Unverified'){
       $this->code->code = rand(1001,9000);
       $code=$shippingAddress->code()->save( $this->code);
       $message = "Your Mobile Activation code is $code->code. Use this code to verify your order";
       $this->sentSmsOrderVerificationCode($shippingAddress,$message);
       }
    }

    protected function sentSmsOrderVerificationCode($shippingAddress,$message)
    {
        $number = $shippingAddress->mobile;
        $originator = Config::get('constants.sms_originator');
        $this->SMSSender->sendSMS($number,$message,$originator);

    }


}