<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 11/24/2015
 * Time: 4:29 PM
 */

namespace Chorki\Shippings;


use Chorki\Repositories\DbRepositories;

class ShippingChannelRepository extends DbRepositories{


    protected $model;

    function __construct(\ShippingChannel $model)
    {
        $this->model = $model;
    }
    public function getShippingChannelList(){
       return $this->model->lists('name','id');
    }
}