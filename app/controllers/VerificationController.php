<?php
use Chorki\shops\Models\ShopRepositoryInterface;

/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 6/1/15
 * Time: 12:25 PM
 */

class VerificationController extends \BaseController{

    private $shop;
    private $shops;

    public function __construct(Chorki\shops\Models\Shop $shop,ShopRepositoryInterface $shops){
        $this->shop = $shop;
        $this->shops = $shops;
    }

    public function verifyShopEmail($emailVerificationCode){
        if(!$emailVerificationCode){
            return View::make('public.shop.emailVerification')->withMessage("Error!!");
        }
        $shop = $this->shop->where('emailVerificationCode', $emailVerificationCode)->first();
        if(!$shop){
            return View::make('public.shop.emailVerification')->withMessage("Wrong Verification Code.");
        }
        $shop->emailVerified = 1;
        $shop->save();
        $title = $shop->title;
        $this->publishShopIfVerificationRulesAreComplete($shop);
        return View::make('public.shop.emailVerification')->withMessage("Success! Your email address for eShop #$title has been verified.");
    }
    public function verifyShopMobile($mobileVerificationCode){
        if(!$mobileVerificationCode){
            return View::make('public.shop.emailVerification')->withMessage("Error!!");
        }
        $shop = $this->shop->where('mobileVerificationCode', $mobileVerificationCode)->first();
        if(!$shop){
            return View::make('public.shop.emailVerification')->withMessage("Wrong Verification Code.");
        }
        $shop->isVerified = 1;
        $shop->save();
        $title = $shop->title;
        $this->publishShopIfVerificationRulesAreComplete($shop);
        return View::make('public.shop.emailVerification')->withMessage("Success! Your mobile number for eShop #$title has been verified.");
    }


    public function publishShopIfVerificationRulesAreComplete($shop)
    {
        if($shop->firstTimePublished !=1 && isEshopVerifiedToShowShopStatusBtn($shop)){
            $shop->firstTimePublished=1;
            $shop->status= 'Published';
            $shop->save();
            $this->shops->notifyChorkiAuthorityByEmail($shop);
            return true;
        }
        else
            return false;
    }
}