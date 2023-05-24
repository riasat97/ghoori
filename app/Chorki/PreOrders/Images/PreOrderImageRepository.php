<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/13/2016
 * Time: 1:45 PM
 */

namespace Chorki\PreOrders\Images;

use Chorki\Repositories\DbRepositories;
use Chorki\shops\Models\ShopRepositoryInterface;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class PreOrderImageRepository extends DbRepositories implements PreOrderImageRepositoryInterface
{
    public $model,$shop;

    public function __construct(\PreorderImage $model,ShopRepositoryInterface $shop)
    {
        $this->model = $model;
        $this->shop = $shop;
    }

    public function savePreOrderImage(){

        $data = Input::all();
        $shop_id = Auth::user()->shop->id;
        // var_dump($data);
        // var_dump($shop_id);
        $old_directory = public_path('/jQuery.filer/uploads');
        // $new_directory = public_path().'/preorder_img';
        $new_directory = public_path().'/public_img/shop_'.$shop_id.'/preorder';
        $orak_directory= public_path().'/img_tmp/thumb';
        if (!folder_exists($new_directory)) {
            mkdir( $new_directory, 0777, true );
        }
        $old_file_name = $data['image_name'];
        $new_file_name = $data['preorder_key'].'_'.$old_file_name;
        copy($old_directory.'/'.$old_file_name , $new_directory.'/'.$new_file_name );
        //   $old_directory_n=public_path().'/preorder_img';
        rename($old_directory.'/'.$old_file_name , $orak_directory.'/'.$new_file_name );

        $this->model->image = $new_file_name;
        $this->model->preorder_key = $data['preorder_key'];
        $this->model->save();

    }

    public function moveImage($images,$preorder_key){
        $old_directory = public_path('img_tmp');
        // $new_directory = public_path().'/preorder_img';
        $new_directory = public_path().'/public_img/shop_'.$shop_id.'/preorder';
        //$orak_directory= public_path().'/img_tmp/thumb';
        if (!folder_exists($new_directory)) {
            mkdir( $new_directory, 0777, true );
        }
        foreach($images as $old_file_name){
            // $new_file_name = $old_file_name;
            $new_file_name = $preorder_key.'_'.$old_file_name;
            if (copy($old_directory.'/'.$old_file_name , $new_directory.'/'.$new_file_name )){

                $this->model->image =$new_file_name;
                $this->model->preorder_key = $preorder_key;
                $this->model->save()->save();
            }
        }
    }

    public function deleteImage($images){

        foreach($images as $v_image){
           $this->model->where('image',$v_image)->delete();
        }
    }
}