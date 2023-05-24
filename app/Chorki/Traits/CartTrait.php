<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 1/3/2016
 * Time: 5:22 PM
 */

namespace Chorki\Traits;


use Illuminate\Support\Facades\View;

trait CartTrait {


    public function getCart ()
    {
        $cartCount = $this->cart->cartCount();
        $cartContents = $this->cart->cartContent();
        $cartTotal = $this->cart->cartTotal();
        return  ['cartCount'=>$cartCount,'cartContents'=>$cartContents,'cartTotal'=>$cartTotal] ;
    }
}