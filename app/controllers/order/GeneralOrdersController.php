<?php

use Chorki\Orders\Models\GeneralOrderRepository;

class GeneralOrdersController extends OrdersController {

    private $generalOrder;

    function __construct(GeneralOrderRepository $generalOrder){

        $this->generalOrder = $generalOrder;
    }
	public function index()
	{
      $res=$this->generalOrder->postUpdateParcelStatus();
      return 'parcel status successfully updated for all orders';

	}
    public function postRevertStockForTemporaryOrders(){
        return $this->generalOrder->postRevertStockForTemporaryOrders();
    }


}