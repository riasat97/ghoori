<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/13/2016
 * Time: 12:44 PM
 */

namespace Chorki\PreOrders\Packages;

use Chorki\PreOrders\PreOrderRepositoryInterface;
use Chorki\Repositories\DbRepositories;
use Chorki\shops\Models\ShopRepositoryInterface;
use Chorki\PreOrders\Packages\PackageRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PackageRepository extends DbRepositories implements PackageRepositoryInterface
{
    public $model,$shop;

    public function __construct(\PreorderPackage $model,ShopRepositoryInterface $shop)
    {
        $this->model = $model;
        $this->shop = $shop;
    }

    public function savePackage(){
        $shop = $this->shop->_getShop();
        $shop_id=Session::get('shop_id');
        $preorder_key=Session::get('preorder_key');
        $preorder_id=Session::get('preorder_id');
        $deps  = Input::only('amount','description','quantity','price','delivery_date');

        $amount = $deps['amount'];
        $description = $deps['description'];
        $quantity = $deps['quantity'];
        $price = $deps['price'];
        $delivery_date = $deps['delivery_date'];

        foreach( $amount as $key => $n ) {
            $this->model->create(
                array(
                    'amount' => $amount[$key],
                    'preorder_id'=>$preorder_id,
                    'description' => $description[$key],
                    'quantity' => $quantity[$key],
                    'price' => $price[$key],
                    'delivery_date' => date('Y-m-d', strtotime(str_replace('-', '/', $delivery_date[$key]))),
                    'status' => "Published",
                    'shop_id' => $shop_id,
                    'preorder_key'=>$preorder_key,
                )
            );
        }
        return ['shop'=>$shop];
    }

    public function editPackage($slug,$preorder_key){

        $shop = $this->shop->_getShop();
        $p_package = $this->model->where('preorder_key',$preorder_key)->get();
        return ['shop'=>$shop,'p_package'=>$p_package];

    }

    public function updatePackage(){

        $shop_id=Session::get('shop_id');
        $preorder_key=Input::get('preorder_key');

        $package=$this->getById(Input::get('preorder_package_id'));
        $package->shop_id=$shop_id;
        $package->preorder_key=$preorder_key;
        $package->amount=Input::get('amount');
        $package->quantity=Input::get('quantity');
        $package->description=Input::get('description');
        $package->price=Input::get('price');
        $package->delivery_date=date('Y-m-d', strtotime(str_replace('-', '/', Input::get('delivery_date'))));
        $package->status=Input::get('status');
        $package->save();

    }

    public function deletePackage($slug,$preorder_package_id){

        $package=$this->getById($preorder_package_id);
       // $package->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $package->save();

    }

    public function getPackages($preorder_key){

        return $this->model->where('preorder_key',$preorder_key)->get();
    }

}