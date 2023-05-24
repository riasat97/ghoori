<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 1/7/2016
 * Time: 1:12 PM
 */

namespace Chorki\Composers\Carts;


use Chorki\Carts\Models\CartRepositoryInterface;
use Chorki\Traits\CartTrait;

class CartsComposer {
use CartTrait;

    protected $cart;

    function __construct(CartRepositoryInterface $cart)
    {
        $this->cart = $cart;
    }

    public function compose($view){
        $viewData= $view->getData();
        $cart= $this->getCart();

        $view->with(['cartCount'=>$cart['cartCount'],'cartContents'=>$cart['cartContents']
            ,'cartTotal'=>$cart['cartTotal']]);
    }
}