<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 5/17/2015
 * Time: 9:18 PM
 */

namespace Chorki\Shippings\ShippingAddresses\Models;


interface ShippingRepositoryInterface {

    public function getShippingAddressByUser();

}