<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 9/12/15
 * Time: 5:38 PM
 */

namespace Chorki\Campaigns;

interface CampaignInterface {
    public function calculateIdealDiscount($unitPrice, $quantity);
    public function calculateDiscount($orderId, $productId, $unitPrice, $quantity);
    public function getStartDate();
    public function getEndDate();
    public function getDiscountComment();
    public function getDiscountRate();//can return both fixed amount or percentage
}