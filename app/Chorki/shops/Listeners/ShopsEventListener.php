<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 5/31/15
 * Time: 12:38 PM
 */

namespace Chorki\shops\Listeners;

use Chorki\shops\Events\ShopWasPosted;
use Illuminate\Support\Facades\App;
use Laracasts\Commander\Events\EventListener;
use Chorki\SMS\SMSSender;
use PackageRequest;
use User;
use URL;
use Mail;
use Config;
use Log;

class ShopsEventListener extends EventListener{

    private $smsSender , $user, $packageRequestRepo;

    public function __construct(User $user, SMSSender $smsSender, PackageRequest $packageRequestRepo){
        $this->smsSender=$smsSender;
        $this->user = $user;
        $this->packageRequestRepo = $packageRequestRepo;
    }

    public function whenShopWasPosted( ShopWasPosted $event){
        $this->emailEmailVerificationURLToUser($event);
        $sendsmsresp = $this->SMSMobileVerificationCodeToUser($event);
        // $this->logShopPackage($event);
        Log::info("ShopWasPosted ye!");
        Log::info("shop Verification sms sent ".$sendsmsresp);
        // App::environment is not accessible from here. // fixed
        
         if (App::environment() == 'production') {
            // $this->sendSmsToChorkiAuthority($event);
         }
        

    }

    private function SMSMobileVerificationCodeToUser($event){
        $code = $event->shop->code->code;
        $number = $event->shop->mobile;
        $message = "Your eShop Mobile Activation code is $code. Use this code to open your eShop. -Ghoori";
        $originator = Config::get('constants.sms_originator');
        $this->smsSender->sendSMS($number,$message,$originator);

    }

    private function emailEmailVerificationURLToUser($event){
        $emailAddress = $event->shop->email;
        $code= $event->shop->emailVerificationCode;
        $confirmationUrl = URL::route('shopEmailVerification',array($code));
        $user = $this->user->find($event->shop->user_id);
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

    private function sendSmsToChorkiAuthority($event)
    {


        $this->sendSmsToBosses($event, 'Nazmus Saquibe', '01913660111');
        $this->sendSmsToBosses($event, 'Rashed Moslem', '01778189750');
        $this->sendSmsToBosses($event, 'Zahidul Amin', '01764111104');


    }

    private function sendSmsToBosses($event, $name, $number)
    {
        $shopTitle = $event->shop->title;
        $shopId = $event->shop->id;
        $message = "Mr. $name, A new eShop#$shopId named $shopTitle is created.";
        $this->smsSend($number,$message);
        return true;
    }
    private function smsSend($number, $message)
    {
        $this->smsSender->sendSMS($number,$message,$originator = Config::get('constants.sms_originator'));
    }

    private function logShopPackage($event){
        $shopId = $event->shop->id;
        $packageId = $event->shop->package_id;
        $params = [
            'shop_id' => $shopId,
            'package_id' => $packageId,
            'status' => 'accepted'
        ];
        $this->packageRequestRepo->create($params);
    }

}