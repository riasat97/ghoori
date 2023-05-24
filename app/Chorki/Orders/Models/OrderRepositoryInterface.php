<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 5/17/2015
 * Time: 7:38 PM
 */

namespace Chorki\Orders\Models;


interface OrderRepositoryInterface {
    public function getAll();
    public function getByTransactionId($transactionId);
    public function restoreOrderProducts($order_id);
    public function getById($id);
    public function getBySlug($slug);
    public function getOrderByShop($shopId);
    public function save(array $input);
    public function isSessionExpired($shopId);
    public function getShippingPackagesByLocation($shippingLocation_id,$totalOrderWeight,$shopId);
    public function getTotalWeightByOrder($orderId);
    public function getTotalWeightByShop($shopId);
    public function getShippingCharge($shippingLocation_id,$shippingPackage_id,$shippingWeight_id);
    public function getCartSubtotalByShop($shopId);
    public function postOrderToCourierService($order,$shop);
    public function getParcelInquiry($parcelId,$shopId);
    public function getOrderByUser();
    public function getCartDiscountedSubtotalByShop($shopId);
    public function postParcelCancel($parcelId,$shopId);
    public function getLatestStatusByTimeIndex($array, $keyToSearch);
    public function postLatestStatus($order,$latestStatus);
    public function postGeneralOrderStatus($order);
    public function getCheckStockAgainWhileOrderProceed($shopId);
    public function getCuponValidity($cuponId,$shopId,$userId);
    public function getShopCuponActivationForActiveCampaign($shopId);
}