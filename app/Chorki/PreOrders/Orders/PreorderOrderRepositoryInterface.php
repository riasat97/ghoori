<?php


/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/25/2016
 * Time: 6:29 PM
 */

namespace Chorki\PreOrders\Orders;

interface PreorderOrderRepositoryInterface
{
    public function savePreBookOrder($shippingCharge);
    public function getNewPreOrderCountByShop($id);
}