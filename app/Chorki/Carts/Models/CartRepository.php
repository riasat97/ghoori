<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 5/9/2015
 * Time: 5:57 PM
 */

namespace Chorki\Carts\Models;


use Chorki\Repositories\CartRepositories;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartRepository extends CartRepositories implements CartRepositoryInterface{

    function __construct(ChorkiCart $model)
    {
        $this->model = $model;


    }

    public function cartAdd(array $input)
    {
       return Cart::associate('Product','Chorki\products\Models')->add($input);
    }

    public function cartUpdate($id,array $input)
    {
       return Cart::update($id, $input);
    }

    public function cartRemove($id)
    {
       return Cart::remove($id);
    }

    public function cartGet($id)
    {
        return Cart::get($id);
    }

    public function cartContent()
    {
      return Cart::content();
    }

    public function cartDestroy()
    {
        return Cart::destroy();
    }

    public function cartTotal()
    {
       return Cart::total();
    }

    public function cartCount()
    {
        return Cart::count();
    }

    public function cartSearch(array $input)
    {
        return  Cart::search($input);
    }


}