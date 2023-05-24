<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 11/25/2015
 * Time: 4:16 PM
 */

namespace Chorki\Payment\Models;


use Chorki\Repositories\DbRepositories;

class PaymentMethodRepository extends DbRepositories{

    protected $paymentMethod;

    function __construct(\PaymentMethod $paymentMethod)
    {
        $this->model = $paymentMethod;
    }
    public function getPaymentMethodList(){
        return $this->model->lists('label','id');
    }
}