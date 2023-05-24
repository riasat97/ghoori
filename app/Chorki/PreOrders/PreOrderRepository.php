<?php
/**
 * Created by PhpStorm.
 * User: Tasfeq
 * Date: 1/12/2016
 * Time: 4:48 PM
 */

namespace Chorki\PreOrders;


use Chorki\Repositories\DbRepositories;
use Chorki\shops\Models\ShopRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Preorder;
use Chorki\PreOrders\Packages\PackageRepositoryInterface;
use Chorki\PreOrders\Images\PreOrderImageRepositoryInterface;
use Auth;

class PreOrderRepository extends DbRepositories implements PreOrderRepositoryInterface
{

    public $model,$shop;

    public function __construct(\Preorder $model,ShopRepositoryInterface $shop,PackageRepositoryInterface $packageRepositoryInterface,PreOrderImageRepositoryInterface $preorderimageRepositoryInterface )
    {
        $this->model = $model;
        $this->shop = $shop;
        $this->packageRepositoryInterface=$packageRepositoryInterface;
        $this->preorderimageRepositoryInterface=$preorderimageRepositoryInterface;
    }

    public function savePreOrder(){

         $weight= self::processWeight(Input::get('weight'),Input::get('weightunit'));

         $this->model->name =Input::get('name');
         $this->model->shop_id =Input::get('shop_id');
         $this->model->description =Input::get('description');
         $this->model->price =Input::get('price');
         $this->model->preorder_key =Input::get('preorder_key');
         $this->model->status ="Published";
         $this->model->product_url =Input::get('product_url');
         $this->model->weight=$weight;
         $this->model->save();

        $preorder_id = $this->model->preorder_id;
        Session::put('preorder_id',$preorder_id);
        Session::put('preorder_key',Input::get('preorder_key'));
        return $this->model;

    }

    public function createPackage(){

        $shop = $this->shop->_getShop();
        $preorder_id = Session::get('preorder_id');
        $preorder=$this->getById($preorder_id);
        return ['shop'=>$shop,'preorder'=>$preorder];

    }

    public function editPreOrderContent($slug,$preorder_id){

      //  $shop = $this->shop->_getShop();
        $shop=$this->shop->getBySlug($slug);
        $preorder=$this->getById($preorder_id);
        $preorder->load('images');

        // $img_directory = public_path('preorder_img');
        $img_directory = public_path().'/public_img/shop_'.$shop->id.'/preorder';
        $tmp_img_directory = public_path('img_pre_tmp');

        $images = array();
        foreach($preorder->images as $v_image){
            $imageLink = $v_image->image;
            copy($img_directory.'/'.$imageLink,$tmp_img_directory.'/'.$imageLink);
            $images[] = $imageLink;
        }
        return ['shop'=>$shop,'preorder'=>$preorder,'images'=>$images];
    }

    public function updatePreOrder(){

        $weight= self::processWeight(Input::get('weight'),Input::get('weightunit'));
        $preorder_key=input::get('preorder_key');
        $preorder= $this->getById(Input::get('preorder_id'));
        $oldImages = array();
        foreach($preorder->images as $v_image){
            $imageLink = $v_image->image;
            $oldImages[] = $imageLink;
        }
        $new_images = array_diff(Input::get('file'),$oldImages);
        $deleted_images = array_diff($oldImages,Input::get('file'));
        if(count($deleted_images)){
        $this->preorderimageRepositoryInterface->deleteImage($deleted_images);
        }
      /*  foreach($deleted_images as $v_image){
            \PreorderImage::where('image',$v_image)->delete();
        }*/

        if($new_images){
             $this->moveImage($new_images,$preorder_key);
        }

        $preorder->shop_id=Session::get('shop_id');
        $preorder->name=input::get('name');
        $preorder->description=input::get('description');
        $preorder->price=input::get('price');
        $preorder->weight=$weight;
        $preorder->status=input::get('status');
        $preorder->save();

        return $preorder;
    }

    public function deletePreorder($slug,$preorder_id){

        $preorder=$this->getById($preorder_id);
        $preorder->status="Unpublished";
        $preorder->deleted_at=\Carbon\Carbon::now()->toDateTimeString();
        $preorder->save();

    }

    public function preorderDetails($slug,$preorder_id){

        $shop = $this->shop->getBySlug($slug);
        $preorder=$this->getById($preorder_id);
        $preorder_key=$preorder->preorder_key;
        $preorder->load('images');
       // $preorder->load('packages')->where('status','=','Published');
        $packages=$this->model->with(array('packages'=>function($q)use($preorder_key){
            $q->where('status','=','Published');
        }))->where('preorder_key',$preorder_key)->where('status','Published')->get();

        return ['shop'=>$shop,'preorder'=>$preorder,'packages'=>$packages];

    }

    public function getPreOrder($slug){

        $shop = $this->shop->getBySlug($slug);
        $shop_id = Auth::user()->shop->id;
        $all_packages=Preorder::
        where('preorders.shop_id','=',$shop_id )->where('preorders.status','=',"Published")
            ->select('preorders.name','preorders.description','preorders.price',
                'preorders.status','preorders.preorder_id','preorders.preorder_key',
                DB::raw("(select image from preorder_images where preorder_key = preorders.preorder_key limit 1)as image "))
            ->get();

        return ['shop'=>$shop,'all_packages'=>$all_packages];

    }

    public function moveImage($images,$preorder_key){
        $old_directory = public_path('img_tmp');
        $shop_id=Auth::user()->shop->id;
        // $new_directory = public_path().'/preorder_img';
        $new_directory = public_path().'/public_img/shop_'.$shop_id.'/preorder';
        //$orak_directory= public_path().'/img_tmp/thumb';
        if (!folder_exists($new_directory)) {
            mkdir( $new_directory, 0777, true );
        }
        foreach($images as $old_file_name){
            $new_file_name = $old_file_name;
            if (copy($old_directory.'/'.$old_file_name , $new_directory.'/'.$new_file_name )){
                $preorderImage=\PreorderImage::create([
                    'image'=>$new_file_name,
                    'preorder_key'=>$preorder_key,
                ]);
            }
        }
        return $preorderImage;
    }

    public function showPreorder($slug){

        $shop = $this->shop->getBySlug($slug);
        $shop_id=$shop['id'];
        $all_packages = DB::table('preorder_packages')
            ->where('preorder_packages.shop_id','=',$shop_id)
            ->rightJoin('preorders', 'preorder_packages.preorder_key', '=', 'preorders.preorder_key')
            ->rightJoin('preorder_images', 'preorders.preorder_key', '=', 'preorder_images.preorder_key')
            ->select('preorders.name','preorder_images.image','preorders.price','preorder_packages.status','preorder_packages.preorder_package_id','preorder_packages.preorder_id','preorder_packages.description','preorder_packages.delivery_date','preorder_packages.quantity')
            ->groupBy('preorder_packages.preorder_key')
            ->where('preorders.status','=',"Published")
            ->get();

        return ['shop'=>$shop,'all_packages'=>$all_packages];
    }

    public static function processWeight($weight, $weightUnit)
    {
        if($weightUnit ==='kg'){
            return $weightInGm=$weight*1000;
        }
        else{
            return $weight;
        }
    }
}