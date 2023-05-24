<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/18/2015
 * Time: 11:28 AM
 */

namespace Chorki\shops\Models;


interface ShopRepositoryInterface {
    public function getAll();
    public function getById($shopId);
    public function getBySlug($slug);
    public function getBySubDomain($subDomain);
    public function getBySlugWithModelAndType($slug,$model);
    public function saveSocialNetwork($model,array  $input);
    public function saveShippingChannels($model,array $input);
    public function savePaymentMethods($model,array $input);
    public function saveCupon($model,array $input);
    public function _getShop();
    public function isMyShop($slug);
    public function getSlugFromSubDomain($domain);
    public function SMSMobileVerificationCodeToUser();
    public function MailVerificationLinkToUser();
    public function publishShopIfVerificationRulesAreComplete();
    public function unPublishShopIfVerificationRulesAreNotComplete();
    public function generateVerificationCode($requiredVerificationCode);
    public function getShopShippingChargeByLocation($shippingLocation_id,$totalOrderWeight,$shop_id);
    public function postEcourierRegistration($shop);
    public function notifyChorkiAuthorityByEmail($shop);
    public function getAllNewestShops();
    public function shopHasGpCampaign($shopId);
    public function viewCount($shop);
    public function loadShop($shop);
    public function hasPrebookFeature($shopId);
}