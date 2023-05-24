<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 1/26/2016
 * Time: 4:33 PM
 */

namespace Chorki\Traits\Revenues;


trait OwnChannelTrait {


    public function getOwnChannelOrderCharges(array $date,$shopId=null,$cod=false){
        $shopId=$this->getShopId($shopId);

         $totalOwnChannelOrderCharges=
                $this->orderDb
                ->ordercompletedbyshop($shopId)
                ->whereNull('shippingPackage_id')
                ->ownchannelcharge($cod)
                ->whereBetween('completed_at', array($date['start'], $date['end']))
                ->get();
        return $totalOwnChannelOrderCharges[0];
    }


}