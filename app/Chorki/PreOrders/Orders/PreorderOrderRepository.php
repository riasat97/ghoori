<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/25/2016
 * Time: 6:30 PM
 */
namespace Chorki\PreOrders\Orders;
use Chorki\Repositories\DbRepositories;
use Chorki\PreOrders\Orders\PreorderOrderRepositoryInterface;
use Chorki\shops\Models\ShopRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Auth;

class PreorderOrderRepository extends DbRepositories implements PreorderOrderRepositoryInterface
{
    public $model,$shop;

    public function __construct(\PreBookOrder $model,ShopRepositoryInterface $shop)
    {
        $this->model = $model;
        $this->shop = $shop;
    }

    public function savePreBookOrder($shippingCharge){
        DB::beginTransaction();

        try{
            $preorder_key=input::get('preorder_key');
            $preorder=\Preorder::where('preorder_key',$preorder_key)->first();

            $shop = $this->shop->_getShop();
            $shop_id=$shop['id'];

            $order= new \PreBookOrder();
            $order->user_id=Auth::user()->id;
            $order->shop_id=$shop_id;
            $order->shippingPackage_id=input::get('shippingPackage_id');
            $order->total=$preorder->price+$shippingCharge;
            $order->shippingLocation_id=input::get('shippingLocation_id');
            $order->preorderPackage_id=input::get('preorder_package_id');
            $order->shippingCharge=$shippingCharge;
            $order->subtotal=$preorder->price;
            $order->status='Pending';
            $order->save();

            $order->setPayment($preorder->price);
            $paymentMethod = Input::get('payment-method');//@todo remove this WORST^17 practice of using Input facade
            $paymentUrl = $order->getPaymentUrl($paymentMethod);


            $prebookOrder = new \PrebookOrderPreorder();
            $prebookOrder->prebook_order_id=$order->id;
            $prebookOrder->preorder_id=$preorder->preorder_id;
            $prebookOrder->quantity=1;
            $prebookOrder->preorderName=$preorder->name;
            $prebookOrder->discount=0.00;
            $prebookOrder->save();

            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            throw $e;
        }

        return ['prebookOrder'=>$prebookOrder,'paymentUrl'=>$paymentUrl];

    }

    public function getNewPreOrderCountByShop($shopId){
        return $this->model->where('shop_id','=',$shopId)->where('prebook_orders.status', '=', 'New')->count();
    }

}