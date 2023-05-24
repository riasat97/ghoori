<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 9/19/15
 * Time: 3:11 PM
 */

namespace Chorki\Campaigns;

use Chorki\Orders\Models\Order;
use DateTime;

class GhooriCampaign implements CampaignInterface{

    private $discountComment = '';

    public function calculateIdealDiscount($unitPrice, $quantity){
        return round($quantity*$unitPrice*0.1);
    }

    public function calculateDiscount($orderId, $productId, $unitPrice, $quantity){
        $order = Order::find($orderId);
        $now = new DateTime("now");
        if($now<$this->getStartDate()){
            return 0.0;
        }
        if($now>$this->getEndDate()){
            return 0.0;
        }

        $this->discountComment = 'Ghoori Campaign: 10% off';
        return round($quantity*$unitPrice*0.1);

    }
    public function getStartDate(){
        return new DateTime('2015-09-15');
    }
    public function getEndDate(){
        return new DateTime('2015-09-24 11:59');
    }
    public function getDiscountComment(){
        return $this->discountComment;
    }
}