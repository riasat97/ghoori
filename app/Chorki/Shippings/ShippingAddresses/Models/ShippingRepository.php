<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 5/17/2015
 * Time: 9:19 PM
 */

namespace Chorki\Shippings\ShippingAddresses\Models;


use Chorki\shops\Models\ShopRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ShippingRepository implements ShippingRepositoryInterface{

    function __construct(ShippingAddress $model)
    {
        $this->model = $model;

    }

    public function getShippingAddressByUser()
    {
      return $this->model->where('user_id',Auth::user()->id)->orderBy('created_at','DESC')->first();
    }
}