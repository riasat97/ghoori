<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/18/2015
 * Time: 11:31 AM
 */

namespace Chorki\shops\Events;


use Chorki\shops\Models\Shop;

class ShopWasPosted {

    public $shop;

    function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }
}