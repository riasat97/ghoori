<?php
namespace Chorki\Composers;

use Chorki\Orders\Models\OrderRepository;
use Session;
use Auth;

class NewOrdersCountForShopsComposer {
 	public function __construct(OrderRepository $orders){
	  $this->orders = $orders;
	}

  	public function compose($view){
        $shop = Auth::user()?Auth::user()->shop:null;
  		if($shop)
		$ordersCount = $this->orders->getNewOrderCountByShop($shop->id);
		else $ordersCount = null;
    	$view->with('ordersCount', $ordersCount);
  	}
}