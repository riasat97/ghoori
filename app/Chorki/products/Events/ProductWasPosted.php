<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/14/2015
 * Time: 11:37 AM
 */

namespace Chorki\products\Events;


use Chorki\products\Models\Product;

class ProductWasPosted {

    public $product;

    function __construct(Product $product)
    {
        $this->product = $product;
    }
}