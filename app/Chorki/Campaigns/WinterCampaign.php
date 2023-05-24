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

class WinterCampaign implements CampaignInterface{

    protected $discountComment = 'Eid 2016';

    protected $discountFactor = 0.15;

    protected $discountRate = '15%';

    public function campaignIsRunning(){
        $now = new DateTime("now");
        if($now<$this->getStartDate()){
            return false;
        }
        if($now>$this->getEndDate()){
            return false;
        }
        return true;
    }

    public function calculateIdealDiscount($unitPrice, $quantity){
        return round($quantity*$unitPrice*$this->discountFactor, 2);
    }

    public function calculateDiscount($orderId, $productId, $unitPrice, $quantity){
        if($this->campaignIsRunning()){
            return $this->calculateIdealDiscount($unitPrice,$quantity);
        }
        return 0.0;
    }
    public function getStartDate(){
        return new DateTime('2016-01-31 18:00');
    }
    public function getEndDate(){
        return new DateTime('2017-02-07 17:59');
    }
    public function getDiscountComment(){
        if($this->campaignIsRunning()){
            return $this->discountComment;
        }
        return '';
    }
    public function getDiscountRate(){
        if($this->campaignIsRunning()){
            return $this->discountRate;
        }
        return null;
    }
}