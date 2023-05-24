<?php

use Chorki\PreOrders\PreOrderRepositoryInterface;
use Chorki\PreOrders\Packages\PackageRepositoryInterface;
use Chorki\PreOrders\Images\PreOrderImageRepositoryInterface;
use Chorki\PreOrders\Orders\PreorderOrderRepositoryInterface;
use Chorki\shops\Models\ShopRepositoryInterface as Shop;
use Chorki\Shippings\ShippingAddresses\Models\ShippingRepositoryInterface as ShippingAddress;
use Chorki\Orders\Models\OrderRepositoryInterface;
use Illuminate\Support\Facades\Input as Input;
use Chorki\SMS\SMSSender;
use Illuminate\Support\Facades\DB;

/**
* pre order controller manages everything related to preorders
*/
class PreorderController extends BaseController
{
    public $order;
	protected $preOrderRepositoryInterface;
    protected $packageRepositoryInterface;
    protected $preorderimageRepositoryInterface;
    protected $preorderOrderRepositoryInterface;
    protected $smsSender;

    function __construct(ShippingAddress $shippingaddress ,Shop $shop,PreOrderRepositoryInterface $preOrderRepositoryInterface,
                         PackageRepositoryInterface $packageRepositoryInterface,
                         SMSSender $smsSender,PreOrderImageRepositoryInterface $preorderimageRepositoryInterface,
                         PreorderOrderRepositoryInterface $preorderOrderRepositoryInterface,OrderRepositoryInterface $order)
    {

        $this->shop = $shop;

        $this->preOrderRepositoryInterface = $preOrderRepositoryInterface;

        $this->packageRepositoryInterface = $packageRepositoryInterface;

        $this->preorderimageRepositoryInterface = $preorderimageRepositoryInterface;

        $this->preorderOrderRepositoryInterface = $preorderOrderRepositoryInterface;

        $this->shippingaddress = $shippingaddress;

        $this->smsSender = $smsSender;

        $this->order = $order;
    }

    public function savePreOrder(){

        $preOrder=$this->preOrderRepositoryInterface->savePreOrder();
        return Redirect::route('create-package');
    }

    public function editPreOrderContent($slug,$preorder_id){
        $preOrderData=$this->preOrderRepositoryInterface->editPreOrderContent($slug,$preorder_id);
        $preorder=$preOrderData['preorder'];
        $shop=$preOrderData['shop'];
        $images=$preOrderData['images'];
        return View::make('shops.myshop._partials.editPreorder',compact('shop','preorder','images'));
    }

    public function createPackage(){

        $preOrderData=$this->preOrderRepositoryInterface->createPackage();
        $preorder=$preOrderData['preorder'];
        $shop=$preOrderData['shop'];
        return View::make('shops.myshop._partials.createPackage',compact('shop','preorder'));

    }

    public function savePackage(){

        $packageData=$this->packageRepositoryInterface->savePackage();
        $shop=$packageData['shop'];
        return Redirect::to('/admin/shops/'.$shop->getSlug().'/preorder-products');
    }

    public function savePreOrderImage(){

        $this->preorderimageRepositoryInterface->savePreOrderImage();
    }

    public function editPackage($slug,$preorder_key){

        $packageData=$this->packageRepositoryInterface->editPackage($slug,$preorder_key);
        $shop=$packageData['shop'];
        $p_package=$packageData['p_package'];
        $preorder=\Preorder::where('preorder_key','=',$preorder_key)->first();
        return View::make('shops.myshop._partials.editPackage',compact('shop','p_package','preorder'));
    }

    public function updatePackage(){

        $this->packageRepositoryInterface->updatePackage();
        return Redirect::back()->with('msg','Package Updated Successfully!');
    }

    public function update_preorder(){

        $this->preOrderRepositoryInterface->updatePreOrder();
        return Redirect::back()->with('info','Product Information changed Successfully!');
    }

    public function moveImage($images,$preorder_key){

        $this->preorderimageRepositoryInterface->moveImage($images,$preorder_key);
        return Redirect::to('/');
    }

    public function deletePackage($slug,$preorder_package_id){

        $this->packageRepositoryInterface->deletePackage($slug,$preorder_package_id);
        return Redirect::back();
    }

    public function check_user_login(){
        $credentials = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );
        if(Auth::attempt($credentials)){
            $redirectUrl = Input::get('redirectUrl',URL::route('home'));
            return Redirect::back()->with('message','Successfully logged in!');
        }else{
            Log::info('Email login failed', array('email' => $credentials['email']));
            return Redirect::back()->with('message','Incorrect Informations');
        }
    }

    public function addPackage($slug,$preorder_key,$preorder_id){

        $shop = $this->shop->_getShop();
        Session::put('shop_id',$shop['id']);
        Session::put('preorder_key',$preorder_key);
        Session::put('preorder_id',$preorder_id);

        $preorder=Preorder::find($preorder_id);
        $preorder->load('images');
        return View::make('shops.myshop._partials.createPackage',compact('shop','preorder'));
    }

    public function deletePreorder($slug,$preorder_id){

        $this->preOrderRepositoryInterface->deletePreorder($slug,$preorder_id);
        return Redirect::back();
    }

    public function showPreorder($slug){

        $preOrderData=$this->preOrderRepositoryInterface->showPreorder($slug);
        $shop=$preOrderData['shop'];
        $all_packages=$preOrderData['all_packages'];

        if($shop->theme && $shop->theme->name == 'dhumketu'){
            if($shop->preorder_status == 1) {
                //$header = View::make($shop->theme->path.'._partials.theme-header', compact('shop'));
                return View::make($shop->theme->path.'._partials.preorder', compact('shop', 'all_packages'));
            }
            else
                return View::make('errors.404');
        }

        $headerSection=View::make('shops.yourshop._partials.header',compact('shop'));
        return View::make('shops.yourshop.preorder',compact('shop','headerSection','all_packages'));
    }

    public function preorderDetails($slug,$preorder_id){

        $preOrderData=$this->preOrderRepositoryInterface->preorderDetails($slug,$preorder_id);
        $shop=$preOrderData['shop'];
        $preorder=$preOrderData['preorder'];
        $packages=$preOrderData['packages'];

        if($shop->theme && $shop->theme->name == 'dhumketu'){
            if($shop->preorder_status == 1) {
//                $header = View::make($shop->theme->path.'._partials.theme-header', compact('shop'));
                return View::make($shop->theme->path.'._partials.preorder_details', compact('shop', 'preorder', 'packages'));
            }
            else
                return View::make('errors.404');
        }

//        $headerSection=View::make('shops.yourshop._partials.header',compact('shop'));
        return View::make('shops.yourshop.preorder_details',compact('shop','headerSection','preorder','packages'));
    }

    public function preorderCheckout($slug,$preorder_package_id){

        $package=PreorderPackage::find($preorder_package_id);
        $preorder_key=$package->preorder_key;
        $preorder=Preorder::where('preorder_key',$preorder_key)->first();

        $shop = $this->shop->getBySlug($slug);
        $shop_id=$shop['id'];

        $totalOrderWeight=$preorder->weight;
        $shippingAddress=$this->shippingaddress->getShippingAddressByUser();
        if(!$shippingAddress){
            $shippingAddress= Auth::user();
        }
        $shippingLocations=\ShippingLocation::all();
        return View::make('shops.yourshop.preordercheckout',compact('shop_id','preorder_package_id','shop','totalOrderWeight','package','shippingAddress','shippingLocations','preorder_key'));
    }

    public function getPreOrder($slug){

        $preOrderData=$this->preOrderRepositoryInterface->getPreOrder($slug);
        $shop=$preOrderData['shop'];
        $all_packages=$preOrderData['all_packages'];
        return View::make('shops.myshop.preorder',compact('shop','all_packages'));
    }

    public function savePreBookOrder(){

        $input=Input::all();
        $shippingCharge=$this->getShippingCost($input);
        $data=$this->preorderOrderRepositoryInterface->savePreBookOrder($shippingCharge);
        $prebookOrder=$data['prebookOrder'];

        return Redirect::to($data['paymentUrl']);
    }

    public function getShippingCost($input){

        if(!Input::get('shippingPackage_id')){//@todo don't use Input facade
            return $shippingCharge = $this->shop->getShopShippingChargeByLocation($input['shippingLocation_id']
                ,$input['totalOrderWeight'],$input['shop_id']
            );
        }
         else{
             return $shippingCharge = $this->getShippingCharge($input['shippingLocation_id'], $input['shippingPackage_id'], $input['shippingWeight_id']);
         }
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
    
    public function getAllOrders($slug){

        $shop=$this->shop->_getShop();
        $orders=$this->getOrderByShop($shop->id);
       // dd($orders);
        $orders->load('paymentMethod','shippingLocation','shippingPackage','shippingAddress','preorderPackage');
        $orderRejected=$this->getOrderRejectionReason($orders);
     // $preordersCount = $this->preorderOrderRepositoryInterface->getNewPreOrderCountByShop($shop->id);
        return View::make('shops.myshop.preordersindex',compact('orders','shop', 'ordersCount','orderRejected'));
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
    public function getOrderByShop($shopId){
        return \PreBookOrder::where('shop_id','=',$shopId)->whereIn('status',array('Proceed', 'New', 'Reject', 'Complete'))->orderBy('prebook_orders.created_at', 'desc')->get();
    }



    public function getpreorderToProceed($prebookorderId){

        $order= \PreBookOrder::find($prebookorderId);
        $order->load('paymentMethod','shippingLocation','shippingPackage','shippingAddress','preorderPackage','shop');
        $shop=$this->shop->_getShop();
        $response=$this->order->postOrderToCourierService($order,$shop);
       // dd($response);
        if($response && $response->status){

          //  $this->sentEmailToCustomer($order,'emails.invoice',' Thanks for purchasing from ghoori.com.bd');
            $this->sendSMSToCustomerAftervalidation($order->shippingAddress->mobile,$order->shippingAddress->name,$order);

            $order->status = 'Proceed';
            if(!empty($response->parcel_id))
            {
                $order->parcelId = $response->parcel_id;
            }
            $order->parcelStatus = $response->status;
            $order->update();

        }
        return Redirect::route('shops.preorderlist',array($shop->getSlug()));
    }

    public function getpreorderDetails(){

        $prebookorderId= Input::get('orderId');
        $preorder_id=\PrebookOrderPreorder::where('prebook_order_id',$prebookorderId)->first()->preorder_id;
        $preorder=\Preorder::find($preorder_id);
        $orderDetails=\PreBookOrder::find($prebookorderId);
        if($orderDetails['paymentMethod_id']==2){
            $transaction = $this->epwTransactionModel->where('mer_txnid',$orderDetails->transaction_id)->get()->first();
            $orderDetails['transaction_status'] = $transaction->pay_status;
        }else{
            $orderDetails['transaction_status'] = 'Will be notified shortly';
        }

        return View::make('shops.myshop._partials.preorderDetails',compact('orderDetails','preorder'));

    }

    protected function sendSMSToCustomerAftervalidation($phone,$name,$order)
    {
        $number = $phone;
        $message = "Dear,".preg_split('/[\s,]+/',$name)[0].".Your Order no. ".($order->id+100000)." is now in process.Thanks for purchasing. -Ghoori";
        $originator = Config::get('constants.sms_originator');
        $this->smsSender->sendSMS($number,$message,$originator);
    }

    public function getPreorderToReject(){
        $order = \PreBookOrder::find((Input::get('order_id')));
        $order->remarks=Input::get('remarks');
        $order->status = 'Reject';
        $order->update();
        $order->load('user','shippingAddress','shippingPackage','paymentMethod','shippingLocation');
        $order['shippingChannel']=$this->getShippingChannel($order);
     //   $this->EmailToCustomer($order,'emails.preorder.preorderRejection','');
        $this->sendSMSToCustomer($order,$this->getMessageForInformingAboutTheRejectedOrderToCustomer($order));
        $shop=$this->shop->_getShop();
        return Redirect::route('shops.preorderlist',array($shop->getSlug()));
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
    protected function EmailToCustomer($order,$view,$msg, $subject = ''){
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

    protected function getMessageForInformingAboutTheRejectedOrderToCustomer($order)
    {
        $name = $order->shippingAddress->name;
        $message = "Dear,".preg_split('/[\s,]+/',$name)[0].".Your Order no. ".($order->id+100000)." has been canceled.Check email for more details. -Ghoori";
        return $message;
    }

    protected function sendSMSToCustomer($order,$msg)
    {
        $number = $order->shippingAddress->mobile;
        $message = $msg;
        $originator = Config::get('constants.sms_originator');
        $this->smsSender->sendSMS($number,$message,$originator);
    }
}