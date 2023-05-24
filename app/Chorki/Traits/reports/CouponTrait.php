<?php
/**
 * Created by PhpStorm.
 * User: shovo
 * Date: 12/10/2015
 * Time: 12:28 PM
 */

namespace Chorki\Traits\reports;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait CouponTrait
{
    public function getCuponValidity($cuponId,$shopId,$userId){
        $status = 'Reject';
        $cuponValid = $this->getCuponValidation($cuponId);
        if(array_key_exists('error',$cuponValid)){
            $this->insertIntoCuponLogs($shopId,$cuponId,$status);
            return $cuponValid;
        }else{
            $cuponExpired = $this->getIsCuponExpired($cuponValid['success']);
            if(array_key_exists('error',$cuponExpired)) {
                $this->insertIntoCuponLogs($shopId,$cuponId,$status);
                return $cuponExpired;
            }else{
                $shopCampaignValid = $this->getShopCampaignValidation($shopId, $cuponValid['success']['id']);
                if(array_key_exists('error',$shopCampaignValid) && $cuponValid['success']['couponType'] != 1 ) {
                    $this->insertIntoCuponLogs($shopId, $cuponId, $status);
                    return $shopCampaignValid;
                }else{
                    $shopValidityForCupon = $this->getShopValidityForCupon($cuponId,$cuponValid['success']);
                    if(array_key_exists('error',$shopValidityForCupon)) {
                        $this->insertIntoCuponLogs($shopId, $cuponId, $status);
                        return $shopValidityForCupon;
                    }else{
                        return $shopValidityForCupon;
                    }
                }
            }
        }
    }

    private function getShopValidityForCupon($cuponId,$cuponInfo){
        $usedCupon = \Couponlog::where('couponId',$cuponId)
            ->Where('status','Accept')
            ->where('user_id',Auth::id())
            ->count();
        $data = $usedCupon>=$cuponInfo['noOfUseable']?array('error'=>'This cupon is highest time used'):array('success'=>$cuponInfo['discount']);
        return $data;
    }

    private function getShopCampaignValidation($shopId, $campaignId){
        $shopCampaignValid = DB::table('campaign_shop')
                            ->where('campaign_id',$campaignId)
                            ->where('shop_id',$shopId)
                            ->get();
        $data = count($shopCampaignValid)?array('success'=>'Shop is valid'):array('error'=>"This shop isn't suscribed this cupon " );
        return $data;
    }

    private function getCuponValidation($cuponId){
        $cuponInfo = \Coupon::join('campaigns','coupons.campaign_id','=','campaigns.id')
            ->where('couponId',$cuponId)
            ->get()
            ->toArray();
        $data = count($cuponInfo)?array('success'=>$cuponInfo[0]):array('error'=>"This cupon isn't valid" );
        return $data;
    }

    private function getIsCuponExpired($cuponInfo){
        $currentDate = strtotime(Carbon::now()->toDateString());
        $endDate = strtotime($cuponInfo['endDate']);
        return $endDate>=$currentDate?array('success'=>'This cupon is valid.'):array('error'=>'Date expired');
    }

    public function insertIntoCuponLogs($shopId,$cuponId,$status){
        $cuponLog = new \Couponlog();
        $cuponLog->couponId = $cuponId;
        $cuponLog->shop_id = $shopId;
        $cuponLog->user_id = Auth::id();
        $cuponLog->status = $status;
        $cuponLog->save();
        return 'saved';
    }

    public function getCuponDiscount($input, $subTotal){
        $cuponDiscountPercent = 0;
        $cuponData = $this->getCuponValidity($input['cuponText'],$input['shop_id'],Auth::id());
        if(array_key_exists('success',$cuponData)){
            $cuponDiscountPercent = $cuponData['success'];
            $this->insertIntoCuponLogs($input['shop_id'],$input['cuponText'],$status='Accept');
        }
        $amount  = round($subTotal*$cuponDiscountPercent/100);
        return $amount;
    }

    public function getShopCuponActivationForActiveCampaign($shopId){
        $campaignList = $this->activeCampaignList();
        if(array_key_exists('success',$campaignList)){
            return 1;
        }elseif(count($campaignList)){
            $data = DB::table('campaign_shop')
                ->whereIn('campaign_id',$campaignList)
                ->where('shop_id',$shopId)
                ->get();
            return count($data)?1:0;
        }else{
         return 0;
        }
    }

    private function activeCampaignList(){
        $campaignList = \Campaign::select('id','couponType')
                        ->where('endDate','>=',Carbon::now()->toDateString())
                        ->get();
        $globalCampaign =  $campaignList->filter(function($list){
                                if($list->couponType==1){
                                    return true;
                                }
                            })->count();

        if($globalCampaign){
            return array('success'=>1);
        }else{
            return $campaignList->lists('id');
        }
    }

}