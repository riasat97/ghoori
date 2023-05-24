<?php

use Chorki\Carts\Models\CartRepositoryInterface;
use Chorki\GeneralStatusRepository;
use Chorki\Orders\Models\MyOrderRepository;
use Chorki\Orders\Models\OrderRepositoryInterface;
use Chorki\products\Models\ProductRepositoryInterface;
use Chorki\Shippings\ShippingAddresses\Models\ShippingRepositoryInterface;
use Chorki\ShippingSDK\ECourier;
use Chorki\shops\Models\ShopRepositoryInterface;
use Chorki\SMS\SMSSender;
use Chorki\Validators\Order\OrderRejectionReasonValidator;
use Illuminate\Support\Facades\DB;
use Chorki\PaymentSDK\EasyPayWay;
use Chorki\PaymentSDK\Doze;
use Log as Log;

class OrdersController extends \BaseController {

    public $order;
    public $cart;
    public $shop;
    protected $shippingPackage;
    protected $shippingAddress;
    protected $product;
    protected $smsSender;
    protected $courier;
    protected $generalStatusRepository;
    protected $epwSDK;
    protected $dozeSDK;
    protected $epwTransactionModel;
    protected $dozeTransactionModel;
    protected $shippingLocationRepo;
    protected $myOrderRepository;

    const DOZE_PAYMENT_METHOD_ID = 3;
    const EPW_PAYMENT_METHOD_ID = 2;

    public function __construct(OrderRepositoryInterface $order,CartRepositoryInterface $cart, MyOrderRepository $myOrderRepository,
                                DozeTransaction $dozeTransactionModel, Doze $dozeSDK, ShopRepositoryInterface $shop,
                                ShippingPackage $shippingPackage, ShippingRepositoryInterface $shippingAddress,
                                ProductRepositoryInterface $product, SMSSender $smsSender,ECourier $courier,
                                GeneralStatusRepository $generalStatusRepository, EasyPayWay $epwSDK,
                                EasyPayWayTransaction $epwTransactionModel, ShippingLocation $shippingLocationRepo){
        $this->order = $order;
        $this->cart = $cart;
        $this->shop = $shop;
        $this->shippingPackage = $shippingPackage;
        $this->shippingAddress = $shippingAddress;
        $this->product = $product;
        $this->smsSender = $smsSender;
        $this->courier = $courier;
        $this->generalStatusRepository = $generalStatusRepository;
        $this->epwSDK = $epwSDK;
        $this->dozeSDK = $dozeSDK;
        $this->dozeTransactionModel = $dozeTransactionModel;
        $this->epwTransactionModel = $epwTransactionModel;
        $this->shippingLocationRepo = $shippingLocationRepo;
        $this->myOrderRepository = $myOrderRepository;
    }
	public function index()//@todo clean it
	{

	}
    public function getAllOrders($slug){
        $shop=$this->shop->_getShop();
        $orders=$this->order->getOrderByShop($shop->id);
        $orders=$this->LazyLoadOrders($orders);
        $orderRejected=$this->getOrderRejectionReason($orders);
        $ordersCount = $this->order->getNewOrderCountByShop($shop->id);
        return View::make('orders.index',compact('orders','shop', 'ordersCount','orderRejected'));
    }
    public function getOrderDetail(){
        $orderId= Input::get('orderId');
        $orderDetails=$this->order->getById($orderId);
        if($orderDetails['paymentMethod_id']==2){
            $transaction = $this->epwTransactionModel->where('mer_txnid',$orderDetails->transaction_id)->get()->first();
            $orderDetails['transaction_status'] = $transaction->pay_status;
        }else{
            $orderDetails['transaction_status'] = 'Will be notified shortly';
        }
        $totalWeight=$this->order->getTotalWeightByOrder($orderId);
        $orderDetails['deliveryCharge']=$this->getShippingCharge($orderDetails);
        //$shippingCharge=$orderDetails->shippingCharge;
        return View::make('orders._partials.orderDetails',compact('orderDetails','totalWeight','shippingCharge'));
//        return Response::json(['success'=>true,
//            'orderDetails'=> $orderDetails
//        ]);

    }

    public function getOrderProductsByOrderId(){
        $orderId= Input::get('orderId');
        $orderDetails=$this->order->getById($orderId);
        // $totalWeight=$this->order->getTotalWeightByOrder($orderId);
        // $orderDetails['deliveryCharge']=$this->getShippingCharge($orderDetails);
        //$shippingCharge=$orderDetails->shippingCharge;
        // return View::make('orders._partials.orderDetails',compact('orderDetails'));
       return Response::json(['success'=>true,
           'products'=> $orderDetails->products
       ]);

    }

    public function getAddOrder($shopId){
        $cuponActive = $this->order->getShopCuponActivationForActiveCampaign($shopId);
        $cartTotal=$this->order->getCartSubtotalByShop($shopId);
        $discountedTotal = $this->order->getCartDiscountedSubtotalByShop($shopId);
        $totalOrderWeight=$this->order->getTotalWeightByShop($shopId);
        $shop_id=$shopId;
        $shop=$this->shop->getById($shopId);
        $shop->load('paymentMethods');
        $shippingAddress=$this->shippingAddress->getShippingAddressByUser();
        if(!$shippingAddress){
            $shippingAddress= Auth::user();
        }
        $shippingLocations=\ShippingLocation::all();
        return View::make('orders.create',compact('shop_id','cartTotal','shop','shippingAddress','totalOrderWeight','shippingLocations','discountedTotal','cuponActive'));
    }

    private function removeItemsFromCart($shopId)
    {
        foreach ($this->cart->cartContent() as $item) {
            if($shopId == $item->options->shop_id){
                $removedItem= $this->cart->cartRemove($item->rowid);
            }
        }
        return $removedItem;
    }

    public function getOrderInfo($order){
        $order->load('user','shippingAddress','shippingPackage','paymentMethod','shippingLocation','products','shop');
        $orderInfo = $order;
        $orderInfo['shippingChannel']=$this->getShippingChannel($orderInfo);
        $orderInfo['deliveryCharge']=$this->getShippingCharge($orderInfo);
        return $orderInfo;
    }

    protected function emailAndSMSAfterOrderPlacing($orderInfo){
        if($orderInfo->status == 'Unverified') {
            $this->sendSMSToChorkiAuthority($orderInfo);
        }
        else {
            $this->sendSMSToCustomer($orderInfo,$this->getMessageForInformingAboutTheNewOrderToCustomer($orderInfo));
            $this->sendSMSToMerchant($orderInfo);
            
            $this->sentEmailToCustomer($orderInfo,'emails.invoice',"Your Order no. ".($orderInfo->id + 100000)." form ".$orderInfo->shop->title." is now in process.", "Order Details");
            $msg = "";
            $subject = "New order placed";
            $this->sentEmailToMerchant($orderInfo,'emails.acceptorder',$msg, $subject);
        }
    }

    protected function saveOrder($input, $status = 'Unverified',$transactionId = null){
        $input['status'] = $status;
        if($transactionId){
            $input['transaction_id']=$transactionId;
        }
        $order=$this->order->save($input);
        return $order;
    }

    protected function getEasyPayWayPaymentURL($input,$transaction_id,$requestedAmount){
        $city=$state = $this->shippingLocationRepo->find($input['shippingLocation_id'])->name;
        $shopId = $input['shop_id'];
        $params = [
            'tran_id'=> $transaction_id,
            'success_url'=> URL::route('easypayway.shopper',[$shopId,'success']),
            'fail_url'=> URL::route('easypayway.shopper',[$shopId,'fail']),
            'cancel_url'=> URL::route('easypayway.shopper',[$shopId,'cancel']),
            'amount'=>$requestedAmount,
            'currency'=>'BDT',
            'desc'=>'Ghoori Items',//@todo input nite hobe
            'cus_name'=>$input['name'],
            'cus_email'=>$input['email'],
            'cus_add1'=>$input['address'],
            'cus_city'=> $city,//@todo input nite hobe
            'cus_state'=> $state,
            'cus_postcode'=>$input['postcode'],
            'cus_country'=>'Bangladesh',
            'cus_phone'=>$input['mobile']
        ];
        $url = $this->epwSDK->getPaymentUrl($params);
        return $url;
    }

    protected function epwResponse(){
        try{
            $transaction = $this->epwTransactionModel->createNewTransaction();
            $transaction_id = $transaction->mer_txnid;//@todo remove request_amount from transaction table
            $order = $this->saveOrder(Input::all(),'PaymentRequested',$transaction_id);
            Input::flash();
            $amount = $order->total;
            $paymentURL = $this->getEasyPayWayPaymentURL(Input::all(),$transaction_id,$amount);
            return Redirect::to($paymentURL);
        }catch (Exception $e){
            return Redirect::back()
                ->withInput()
                ->with('flash_message', $e->getMessage())
                ->with('flash_type', 'alert-danger');
        }
    }

    protected function dozeResponse(){
        $shopId = Input::get('shop_id');
        $success_url = URL::route('doze.payment',[$shopId,'success']);
        $fail_url = URL::route('doze.payment',[$shopId,'fail']);
        try{
            $transaction = $this->dozeTransactionModel->createNewTransaction();
            $transaction_id = $token = $transaction->token;
            $order = $this->saveOrder(Input::all(),'PaymentRequested',$transaction_id);
            Input::flash();
            $paymentURL = $this->dozeSDK->getLoginUrl($token,$success_url,$fail_url);
            return Redirect::to($paymentURL);
        }catch (Exception $e){
            return Redirect::back()
                ->withInput()
                ->with('flash_message', $e->getMessage())
                ->with('flash_type', 'alert-danger');
        }
    }

	public function store(){

        if($this->order->isSessionExpired(Input::get('shop_id'))){
            return Redirect::route('carts.index')->with('flash_message', '<b>Session Expired</b>')
                ->with('flash_type', 'alert-danger');
        }

        $products=$this->order->getCheckStockAgainWhileOrderProceed(Input::get('shop_id'));
        if($products[0] != true){
            unset($products[0]);
            return Redirect::route('carts.index')->with('error_message', $products)->with('flash_type', 'alert-danger');
        }

        if(Input::get('paymentMethod_id')==self::EPW_PAYMENT_METHOD_ID){
            return $this->epwResponse();
        }elseif(Input::get('paymentMethod_id')==self::DOZE_PAYMENT_METHOD_ID){
            return $this->dozeResponse();
        }else{
            try {
                $order = $this->saveOrder(Input::all());
                $this->removeItemsFromCart(Input::get('shop_id'));
                $orderInfo = $this->getOrderInfo($order);
                $this->emailAndSMSAfterOrderPlacing($orderInfo);
                return Redirect::route('orders.verify',[$orderInfo->id])->with('flash_message', '<b>Order successfully placed</b>')
                    ->with('flash_type', 'alert-success')
                    ->with('order',$orderInfo);
            } catch (Exception $e) {
                return Redirect::route('carts.index')->with('error_message', 'Order cannot be saved right now. Please try later.')->with('flash_type', 'alert-danger');
            }
        }
	}
    public function epwTransaction($shopId,$status){
        $transactionId = Input::get('mer_txnid');
        $transactionDetails = $this->epwSDK->lookupTransactionDetails($transactionId);
        if(isset($transactionDetails['status'])&&$transactionDetails['status']=='Invalid-Data'){
            return Redirect::back()
                ->with('flash_message', 'Invalid Data!!')
                ->with('flash_type', 'alert-danger');
        }
        $allowedColumns = $this->epwTransactionModel->getFillable();
        $updateValues = array_only($transactionDetails,$allowedColumns);
        $transaction = $this->epwTransactionModel->where('mer_txnid',$transactionId)->first();
        $transaction->update($updateValues);

        $order = $this->order->getByTransactionId($transactionId);

        if(!$order){
            throw new Exception("Trxid $transactionId has no corresponding order!!");
        }

        if($status=='success'){
            $order->status = 'New';
            $order->save();
            $this->updateShippingAddressStatus($order->shippingAddress);
            $this->removeItemsFromCart($order->shop_id);
            $orderInfo = $this->getOrderInfo($order);
            $this->emailAndSMSAfterOrderPlacing($orderInfo);
            return Redirect::route('carts.index')->with('flash_message', '<b>Order successfully placed</b>')
                ->with('flash_type', 'alert-success')
                ->with('order',$orderInfo);
        }else{
            $this->order->restoreOrderProducts($order->id);
            $order->status = 'PaymentFailed';
            $order->save();
            return Redirect::route('orders.addOrder',[$shopId])
                ->withInput(Input::old())
                ->with('flash_message', "<b>Payment Failed!! </b> {$transactionDetails['error_title']}")
                ->with('flash_type', 'alert-danger');
        }
    }
    public function getShippingPackages(){
        $shopId=Input::get('shop_id');
        $shippingLocation_id= Input::get('shippingLocation_id');
        $totalOrderWeight = Input::get('totalOrderWeight') > 0 ? Input::get('totalOrderWeight') : 1 ;
        $results= $this->order->getShippingPackagesByLocation($shippingLocation_id,$totalOrderWeight,$shopId);
        $ownShippingCharge=$this->shop->getShopShippingChargeByLocation($shippingLocation_id,$totalOrderWeight,$shopId);
        return Response::json(['success'=>true,
            'data'=> $results,'ownShippingCharge'=>$ownShippingCharge
        ]);
    }

    public function getOrderToProceed($orderId){
        $order = $this->order->getById($orderId);
        $order->load('user','shippingAddress','shippingPackage','paymentMethod','shippingLocation','products');
        
        $shop=$this->shop->_getShop();

        $response=$this->order->postOrderToCourierService($order,$shop);
      //  dd($response);
        Log::info('Ecourier response for '.$orderId, ['response' => $response]);

        if($response && $response->status){

            $order['shippingChannel']=$this->getShippingChannel($order);

            $this->sentEmailToCustomer($order,'emails.invoice','Thanks for purchasing from ghoori.com.bd','Thanks for purchasing from ghoori.com.bd');
            $this->sendSMSToCustomer($order,$this->getMessageForInformingAboutTheProceedOrderToCustomer($order));
            unset( $order['shippingChannel']);

            $order->status = 'Proceed';
            $order->update();
            $this->postParcelId($response,$order);
            $this->order->postGeneralOrderStatus($order);
            Log::info('Order accepted '.$orderId, ['response' => $response]);
        }
        else {

        }
        return Redirect::route('orders.all',array($shop->getSlug()));
    }

    protected function postParcelId($response,$order)
    {
        if ( !empty($response->parcel_id) ) {
            $order->parcelId=$response->parcel_id;
            $order->parcelStatus=$response->status.'@'.\Carbon\Carbon::now()->addHours(6)->toDateTimeString();
            $order->save();
            return true;
        }else{
            return false;
        }


    }
    public function getOrderToReject(){
        $order = $this->order->getById(Input::get('order_id'));
        $this->order->restoreOrderProducts($order->id); //@todo replaced with restoreProduct which is to be removed after january
        $order->remarks=Input::get('remarks');
        $order->status = 'Reject';
        $order->update();
        $this->order->postGeneralOrderStatus($order);
        $order->load('user','shippingAddress','shippingPackage','paymentMethod','shippingLocation','products');
        $order['shippingChannel']=$this->getShippingChannel($order);
        $this->sentEmailToCustomer($order,'emails.orderRejection','');
        $this->sendSMSToCustomer($order,$this->getMessageForInformingAboutTheRejectedOrderToCustomer($order));
        $shop=$this->shop->_getShop();
        return Redirect::route('orders.all',array($shop->getSlug()));
    }
    protected function sentEmailToCustomer($order,$view,$msg, $subject = ''){
        $emailAddress = $order->shippingAddress->email;
        $userName =  $order->shippingAddress->name;
        $data = array(
            'emailAddress' => $emailAddress,
            'userName'=>$userName,
            'order'=>$order,
            'msg'=> $msg,
            'subject' => $subject,
            'link'=>null
        );
        $this->mail($view,$data, $subject);

    }
    protected function sentEmailToMerchant($order,$view,$msg, $subject = ''){
        $emailAddress = $order->shop->email;
        $userName =  $order->shop->user->name;
        $acceptURL = route('orders.proceed', [$order->id]);
        $allOrders = route('orders.all', [$order->shop->slug]);
        $data = array(
            'emailAddress' => $emailAddress,
            'shopTitle' => $order->shop->title,
            'userName'=>$userName,
            'order'=>$order,
            'msg'=> $msg,
            'subject' => $subject,
            'link'=>true,
            'acceptURL' => $acceptURL,
            'allOrders' => $allOrders
        );
        $this->mail($view,$data, $subject);

    }
    public function mail($view,$data){
        Mail::queue($view, $data, function($message) use ($data)
        {
            $message->to( $data['emailAddress'], $data['userName'])->subject($data['subject']);
        });
    }

    protected function restoreProduct($order) //@todo has been moved to repository delete after januray
    {
        foreach($order->products as $orderedProduct){
            $product= $this->product->getById($orderedProduct->pivot->product_id);
            $restoreQty= $product->stock+$orderedProduct->pivot->quantity;
            $product->stock=$restoreQty;
            $product->update();
        }
    }

    protected function sendSMSToCustomer($order,$msg)
    {
            $number = $order->shippingAddress->mobile;
            $message = $msg;
            $originator = Config::get('constants.sms_originator');
            $this->smsSender->sendSMS($number,$message,$originator);
    }
    protected function sendSMSToMerchant($order,$msg="You received a new order form your eShop")
    {
        switch (App::environment()):
            case "local":
                $name = $order->shop->user->name;
                $number = $order->shop->mobile;
                $message = "Dear,".preg_split('/[\s,]+/',$name)[0].".".$msg .$order->shop->title." -lOCAL";
                $originator = Config::get('constants.sms_originator');
                $this->smsSender->sendSMS($number,$message,$originator);
                break;
            case "production":
                $name = $order->shop->user->name;
                $number = $order->shop->mobile;
                $message = "Dear,".preg_split('/[\s,]+/',$name)[0].".".$msg.$order->shop->title." -Ghoori";
                $originator = Config::get('constants.sms_originator');
                $this->smsSender->sendSMS($number,$message,$originator);
                break;
            default:
                // return $url;
                break;

        endswitch;
            
    }
    protected function sendSMSToChorkiAuthority($order)
    {
        switch (App::environment()):
            case "local":
                // return $url;
                break;
            case "production":
                $this->sendSmsToBosses('01913660111', "Nazmus Saquibe", $order);
                $this->sendSmsToBosses('01778189750', 'Rashed Moslem', $order);
                $this->sendSmsToBosses('01764111104', 'Zahidul Amin', $order);
                break;
            default:
                // return $url;
                break;

        endswitch;
        
    }


    protected function sendSmsToBosses($number, $name, $order)
    {
        $message = "Dear, $name. eShop named ".$order->shop->title." received a new order".($order->id + 100000)."  -Ghoori";
        $this->smsSend($number,$message);
    }

    protected function smsSend($number, $message)
    {
        $this->smsSender->sendSMS($number,$message,$originator='Ghoori');
    }

    protected function getMessageForInformingAboutTheNewOrderToCustomer($order)
    {
        $name = $order->shippingAddress->name;
        $message = "Dear, ".preg_split('/[\s,]+/',$name)[0].". Your Order no. ".($order->id+100000)." is now in process. -Ghoori";
        return $message;
    }
    protected function getMessageForOrderRejectionByCustomer($order)
    {
        $name = $order->shippingAddress->name;
        $message = "Dear, ".preg_split('/[\s,]+/',$name)[0].". Your Order no. ".($order->id+100000)." is canceled. -Ghoori";
        return $message;
    }

    protected function getMessageForInformingAboutTheProceedOrderToCustomer($order)
    {
        $name = $order->shippingAddress->name;
        $message = "Dear, ".preg_split('/[\s,]+/',$name)[0].".Your Order no. ".($order->id+100000)." has been confirmed by merchant. Check email for more details. -Ghoori";
        return $message;
    }

    protected function getMessageForInformingAboutTheRejectedOrderToCustomer($order)
    {
        $name = $order->shippingAddress->name;
        $message = "Dear, ".preg_split('/[\s,]+/',$name)[0].".Your Order no. ".($order->id+100000)." has been canceled. Check email for more details. -Ghoori";
        return $message;
    }

    protected function getShippingCharge($order)
    {
        if($order->shippingCharge){
            return $shippingCharge=$order->shippingCharge;
        }
        elseif(!$order->shippingPackage_id){
                 if($order->totalOrderWeight){
                return $shippingCharge=$this->getOwnShippingCharge($order,$order->totalOrderWeight);
          }
               else{
              $totalOrderWeight=$this->order->getTotalWeightByOrder($order->id);
              return $shippingCharge = $this->getOwnShippingCharge($order,$totalOrderWeight);
          }
        }
        else{
       return $shippingCharge=$this->order->getShippingCharge($order->shippingLocation_id,$order->shippingPackage_id,$order->shippingWeight_id);
        }
    }
    protected function getOwnShippingCharge($order,$totalOrderWeight){
        return $shippingCharge = $this->shop->getShopShippingChargeByLocation($order->shippingLocation_id
            ,$totalOrderWeight,$order->shop_id
        );
    }
    protected function getShippingChannel($order)
    {
        if($order->shippingPackage){
            return $shippingChannel= $order->shippingPackage->shippingChannel->name;
        }
        else{
            return $shippingChannel= "Merchant's Shipping Method";
        }
    }

    public function migrateOrdersToNewSystem() {
        if (Input::get('confirm') == 'true') {
            $orders = DB::table('orders')->select('id')->get();
            foreach ($orders as $key => $order) {
                $productIds = DB::table('order_product')->select('product_id')->where('order_id', $order->id)->get();
                // var_dump($productIds);
                $weightSum = 0;
                foreach ($productIds as $key => $productId) {
                    $productWeight = DB::table('products')->select('weight')->where('id', $productId->product_id)->first();
                    $weightSum = $weightSum + $productWeight->weight;
                    // var_dump($productWeight);
                    // echo "<br>\n";
                }

                // DB::table('users')
                // ->where('id', 1)
                // ->update(array('votes' => 1));
                $weightCode = 0;
                if ($weightSum <= 500) {
                    $weightCode = 1;
                }
                elseif ($weightSum > 500 && $weightSum <=1000) {
                    $weightCode = 2;
                }
                elseif ($weightSum > 1000 && $weightSum <=2000) {
                    $weightCode = 3;
                }
                DB::table('orders')
                ->where('id', $order->id)
                ->update(array('shippingWeight_id' => $weightCode));
                echo "$order->id : $weightSum";
                echo "\n<br>";
            } # code...
        }
        else {
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>migrate orders</title>
            </head>
            <body>
            
            </body>
            </html>
            <?php
        }
        
        
    }

    public function getParcelInquiry(){

        $parcelId=Input::get('parcelId');
        $shopId=Input::get('shopId');

        $orderId=Input::get('orderId');
        $order= $this->order->getById($orderId);

        $parcelStatus=$this->order->getParcelInquiry($parcelId,$shopId);
        $status=$parcelStatus[0]->status;
        $latestStatus=$this->order->getLatestStatusByTimeIndex($status,'2');
        $this->order->postLatestStatus($order,$latestStatus);

        return Response::json(['success'=>true,'parcelStatus'=>$latestStatus['status'],
            'date'=>$latestStatus['time']]);
    }




    protected function LazyLoadOrders($orders)
    {
        $orders->load('user','shippingAddress','shippingPackage','paymentMethod','shippingLocation','products','orderRejectionReason');
        return $orders;
    }


    protected function getOrderRejectionReason($orders)
    {
        $remarks=[];
        $customer='Customer :';
        foreach($orders as $key=>$order){
            if(!empty($order->remarks)){
                $remarks[$order->id]= 'You :'.$order->remarks;
            }
        elseif($rejection=$order->orderRejectionReason){
                if($rejection->rejectionreason){
                    $remarks[$order->id]= $customer .$rejection->rejectionreason->reason;
                }
                else{
                    $remarks[$order->id]=  $customer .$rejection->reason;
                }
        }
         else  $remarks[$order->id]= 'N/A';
    }
         return $remarks;
    }



    public function dozeTransaction($shopId,$status){
        $invalidUser = (Input::get('validUser')=='false')?true:false;
        $email = Input::get('username');
        $userId = Input::get('name');
        $transactionId = $token = Input::get('token');

        $order = $this->order->getByTransactionId($transactionId);
        if(!$order){
            throw new Exception("Trxid $transactionId has no corresponding order!!");
        }

        $transaction = $this->dozeTransactionModel->where('token',$token)->first();

        if($status == 'fail'||$invalidUser){
            $this->order->restoreOrderProducts($order->id);
            $order->status = 'PaymentFailed';
            $order->save();
            $transaction->status = 'login_failed';
            $transaction->save();
            return Redirect::route('orders.addOrder',[$shopId])
                ->withInput(Input::old())
                ->with('flash_message', "<b>Payment Login Failed!!</b>")
                ->with('flash_type', 'alert-danger');
        }

        $amount = $order->total;
        $transaction->name = $userId;
        $transaction->username = $email;
        $transaction->amount = $amount;
        $transaction->status = 'unknown';
        $transaction->save(); // in case of timeout

        $payment = $this->dozeSDK->makePayment($amount,$email,$userId);

        $transaction->payment_response_code = $payment->code;
        if($payment->success){
            $order->status = 'New';
            $order->save();
            $transaction->status = 'payment_success';
            $transaction->save();
            $this->updateShippingAddressStatus($order->shippingAddress);
            $this->removeItemsFromCart($order->shop_id);
            $orderInfo = $this->getOrderInfo($order);
            $this->emailAndSMSAfterOrderPlacing($orderInfo);
            return Redirect::route('carts.index')->with('flash_message', '<b>Order successfully placed</b>')
                ->with('flash_type', 'alert-success')
                ->with('order',$orderInfo);
        }else{
            $this->order->restoreOrderProducts($order->id);
            $order->status = 'PaymentFailed';
            $order->save();
            $transaction->status = 'payment_failed';
            $transaction->save();
            return Redirect::route('orders.addOrder',[$shopId])
                ->withInput(Input::old())
                ->with('flash_message', "<b>Payment Failed!! </b> {$payment->message}")
                ->with('flash_type', 'alert-danger');
        }
    }
    public function getCuponValidity(){
        $cuponId = Input::get('cuponId');
        $shopId = Input::get('shopId');
        $userId = Auth::id();
        $data = $this->order->getCuponValidity($cuponId,$shopId,$userId);
        return $data;
    }
    private function updateShippingAddressStatus($shippingAddress)
    {
        $shippingAddress->status=true;
        $shippingAddress->update();
    }

}
