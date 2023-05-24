<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/18/2015
 * Time: 11:27 AM
 */

namespace Chorki\shops\Models;


use Campaign;
use Carbon\Carbon;
use Chorki\Payment\Models\PaymentMethodLogRepository;
use Chorki\Repositories\DbRepositories;
use Chorki\ShippingSDK\ECourier;
use Chorki\SMS\SMSSender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;
use User;
use PackageRequest;

class ShopRepositoryDb extends DbRepositories implements ShopRepositoryInterface{

    protected $mode,$verificationCode, $smsSender, $user, $ecourier, $ecourierRegistration, $bank,$bkash,
              $paymentMethodLogRepository;


    function __construct(Shop $model,SMSSender $smsSender,User $user,ECourier $ecourier,
                         \EcourierRegistration $ecourierRegistration, PackageRequest $packageRequestRepo,
                          \Bank $bank,\Bkash $bkash,PaymentMethodLogRepository $paymentMethodLogRepository)
    {
        $this->model = $model;
        $this->smsSender = $smsSender;
        $this->user = $user;
        $this->ecourier = $ecourier;
        $this->ecourierRegistration = $ecourierRegistration;
        $this->packageRequestRepo = $packageRequestRepo;
        $this->bank = $bank;
        $this->bkash = $bkash;
        $this->paymentMethodLogRepository = $paymentMethodLogRepository;
    }

    public function save(Shop $shop)
    {
        $shop->save();
        $shopId= $shop->id;
        $myshop=$this->getById($shopId);
        $mobileVerificationCode= new \VerificationCode(array(
            'code'=>rand(1001,9000)
        ));
        $myshop->code()->save($mobileVerificationCode);
        $myshop->paymentMethods()->attach(1);
        $myshop->shippingChannels()->attach(1);
        $loggedPackage=$this->logShopPackage($shop);
        return $myshop;
    }

    private function logShopPackage($shop){
        $shopId = $shop->id;
        $packageId = $shop->package_id;
        $params = [
            'shop_id' => $shopId,
            'package_id' => $packageId,
            'status' => 'accepted',
            'accepted_at' => Carbon::now()->toDateTimeString()
        ];
        return $this->packageRequestRepo->create($params);
    }
    public function getBySlugWithModelAndType($slug,$model){

        return $this->model->with($model)->where('slug','=',$slug)->get();
    }
    public function _getShop(){
       return Auth::user()->shop;
    }

    public function saveSocialNetwork($model, array $input)
    {
        $socialNetworks= $model->shopSocialNetwork;
        if($socialNetworks){
        $this->_saveSocialNetwork($socialNetworks,$input,$model,'shopSocialNetwork');
        }else{
        $socialNetworks=new \ShopSocialNetwork();
        $this->_saveSocialNetwork($socialNetworks,$input,$model,'shopSocialNetwork');
        }
    }
    private function _saveSocialNetwork($model,$input,$shop,$function){
        $model->facebook = $input['facebook'];
        $model->twitter= $input['twitter'];
        $model->youtube= $input['youtube'];
        $shop->$function()->save($model);
    }

    public function saveShippingChannels($model, array $input)
    {
        $shippingChannels=Input::get('shippingChannel_id');
        $shopShippingChannels=$model->shippingChannels;
        if($shopShippingChannels->count()){
           foreach($shopShippingChannels as $shopShippingChannel){
               $model->shippingChannels()->detach($shopShippingChannel);
           }
            if(!empty($shippingChannels)){
           foreach($shippingChannels as $shippingChannel) {
                $model->shippingChannels()->attach($shippingChannel);
            }
            }
        }elseif(!$shopShippingChannels->count()) {
            if (!empty($shippingChannels)){
                foreach ($shippingChannels as $shippingChannel) {
                    $model->shippingChannels()->attach($shippingChannel);
                }
        }
        }
    }
    public function savePaymentMethods($model, array $input)
    {   $this->paymentMethodLogRepository->postLogDetachedPaymentMethod($model,$input['paymentMethod_id']);
        $paymentMethods=$input['paymentMethod_id'];
        $shopPaymentMethods=$model->paymentMethods;
        if($shopPaymentMethods->count()){
            foreach($shopPaymentMethods as $shopPaymentMethod) {
                $model->paymentMethods()->detach($shopPaymentMethod);
            }
            foreach($paymentMethods as $paymentMethod) {
                $model->paymentMethods()->attach($paymentMethod);
            }

        }
        elseif(!$shopPaymentMethods->count())
        {
            foreach($paymentMethods as $paymentMethod){
                $model->paymentMethods()->attach($paymentMethod);
            }
        }
        $this->paymentMethodLogRepository->postLogPaymentMethod($model,$paymentMethods);
    }

    public function isMyShop($slug)
    {
        if((!Auth::user())||(!Auth::user()->shop)){
            return false;
        }

        $shop=$this->getBySlug($slug);

        if($shop->id == Auth::user()->shop->id){
            return true;
        }
        return false;
    }
    public function getSlugFromSubDomain($subDomain){
        $shop = $this->model->where('subDomain',$subDomain)->first();
        if($shop){
            return $shop->slug;
        }
        return null;
    }
    public function SMSMobileVerificationCodeToUser(){
        $shop= $this->_getShop();
        $verificationCode=$shop->code;
        $count=$verificationCode->resendCount;

        if($count <= 2){
            $resendCount=$count+1;
            $verificationCode->resendCount=$resendCount;
            $shop->code()->save($verificationCode);
            $code = $shop->code->code;
            $number = $shop->mobile;

            $message = "Your eShop Mobile Activation code is $code. Use this code to open your eShop.";
            $originator = Config::get('constants.sms_originator');
            $this->smsSender->sendSMS($number,$message,$originator);
            return true;
        }
        else return false;

    }
    public function MailVerificationLinkToUser(){
        $shop= $this->_getShop();
        $emailAddress = $shop->email;
        $code= $shop->emailVerificationCode;
        $confirmationUrl = URL::route('shopEmailVerification',array($code));
        $user = $this->user->find($shop->user_id);
        $userName = $user->name;
        $data = array(
            'emailAddress' => $emailAddress,
            'confirmationUrl'=>$confirmationUrl,
            'userName'=>$userName,
            'content'=> 'email address',
            'number'=>null
        );
        Mail::queue('emails.shopEmailVerification', $data, function($message) use ($data)
        {
            $message->to( $data['emailAddress'], $data['userName'])->subject('Email Address Verification');
        });
    }

    public function getBySubDomain($subDomain){
        $shop = $this->model->where('subDomain',$subDomain)->first();
        return $shop;
    }

    public function publishShopIfVerificationRulesAreComplete()
    {
      $shop=$this->_getShop();
      if($shop->firstTimePublished !=1 && isEshopVerifiedToShowShopStatusBtn($shop)){
          $shop->firstTimePublished=1;
          $shop->status= 'Published';
          $shop->save();
          $this->notifyChorkiAuthorityByEmail($shop);
          return true;
      }
      else
          return false;
    }
    public function unPublishShopIfVerificationRulesAreNotComplete(){
        $shop=$this->_getShop();
        if(!isEshopVerifiedToShowShopStatusBtn($shop)){
            $shop->firstTimePublished=0;
            $shop->status= 'Unpublished';
            $shop->save();
            return true;
        }
        else
            return false;
    }
    public function generateVerificationCode($requiredVerificationCode){
        do{
            $verificationCode = md5(uniqid(time(),true));
            $shopWithSameVerificationCode = Shop::where($requiredVerificationCode, $verificationCode)->first();
        }while($shopWithSameVerificationCode);
        return $verificationCode;
    }
    public function getShopShippingChargeByLocation($shippingLocation_id, $totalOrderWeight,$shop_id)
    {

       /* $shopShippingLocation = $this->model->with(array('shippingLocations' => function($query)  use ($shippingLocation_id)
        {
            $query->where('shippingLocation_id', $shippingLocation_id);
        }))->find($shop->id);
       dd($shopShippingLocation->shippingLocations[0]['pivot']['unitCost']);*/

        $shopShippingCharge= DB::table('shop_shippinglocation')
                            ->join('shops','shop_shippinglocation.shop_id','=','shops.id')
                            ->where('ownChannel',true)
                            ->where('shop_id',$shop_id)
                            ->where('shippingLocation_id',$shippingLocation_id)
                            ->pluck('unitCost');
        if(is_null($shopShippingCharge)){
          return false;
        } else {
            $totalOrderWeightInKg = ceil($totalOrderWeight / 1000);
            $shopShippingChargetotal = $shopShippingCharge * $totalOrderWeightInKg;
             return $shopShippingChargetotal;
        }

    }
    public function postEcourierRegistration($shop)
    {
        $ecourier=$this->ecourier->registerShop($shop);
       // dd($ecourier);
        $this->ecourierRegistration->create([
            'user_name'=>$ecourier->user_name,
            'api_secret'=>$ecourier->api_secret,
            'api_key'=>$ecourier->api_key,
            'user_id'=>$ecourier->user_id,
            'password'=>$ecourier->password,
            'shop_id'=>$shop->id
        ]);
    }

    public function notifyChorkiAuthorityByEmail($shop)
    {
        $data = array(
            'emailAddress' =>'rashed.moslem@chorki.com',
            'userName'=>'Rashed moslem',
            'shop'=>$shop
        );
        Mail::queue('emails.shopautopublish', $data, function($message) use ($data)
        {
            $message->to( $data['emailAddress'], $data['userName'])->subject("eShop Auto Published Notification");
        });
    }

    public function getAllNewestShops()
    {
       $twoweekago = date('Y-m-d H:i:s', strtotime('-2 week'));

       return $this->model->where('status','Published')
              ->join('logos', 'shops.id', '=', 'logos.shop_id')
              ->select('*','shops.id As shopId','logos.id As logoId')
              ->where('chorkiVerified',1)->orderBy('shops.id', 'desc')
              ->where('shops.created_at', '>=', $twoweekago)->take(12)->get();
    }

    public function getFeaturedShops()
    {
       return $this->model->where('status','Published')
              ->rightJoin('featuredshops', 'shops.id', '=', 'featuredshops.shop_id')              
              ->join('logos', 'featuredshops.shop_id', '=', 'logos.shop_id')
              ->select('*','shops.id As shopId','featuredshops.id As rank','logos.id As logoId')
              ->where('chorkiVerified',1)->orderBy('featuredshops.order', 'asc')->orderBy('featuredshops.id', 'asc')->get();
    }
    public function shopHasGpCampaign($shopId)
    {
        $shop= $this->getById($shopId);
        $shopHasGpCampaign = $shop->campaigns()->where('campaigns.id',1)->first();
        /* dd($shopHasGpCampaign->toArray());*/
        if($shopHasGpCampaign && $shopHasGpCampaign->active){

            return true;
        }
        else{
            return false;
        }
    }

    public function viewCount($shop)
    {
        $this->countviewer($shop,'shopview','shop_id');
    }
    public function loadShop($shop){
       return $shop->load('user','package');
    }

    public function saveCupon($model, array $input){
        $cupon = array_key_exists('cupon',$input)?1:0;
        $model->coupon = $cupon;
        $model->save();
    }

    public function cuponCampaignList($shopId){
        $date = Carbon::now()->toDateString();
        $data = Campaign::select('id','name','discount','startDate','endDate','couponType')
            ->whereNotNull('campaigns.couponType')
            ->where('campaigns.endDate','>=',$date)
            ->groupBy('campaigns.id')
            ->get()->toArray();

        $shopCuponList = $this->getShopCuponActivationStatus($shopId);

        $finalData = [];
        foreach($data as $item){
            $arr=[];
            if(count($shopCuponList)){
                foreach($shopCuponList as $baby){
                    if($baby->campaign_id==$item['id']){
                        $arr =array_merge($item,array('active'=>1));
                        break;
                    }
                    $arr = $item;
                }
            }else{
                $arr =$item;
            }
            array_push($finalData,$arr);
        }
        return $finalData;
    }

    public function getShopCuponActivationStatus($shopId){
        $data = DB::table('campaign_shop')->select('shop_id','campaign_id')
                ->where('shop_id',$shopId)->get();
        return $data;
    }

    public function hasPrebookFeature($shopId){
        $shop= $this->getById($shopId);
        return $shop->preorder_status ? true : false;
    }

}