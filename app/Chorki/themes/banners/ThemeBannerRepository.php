<?php
/**
 * Created by PhpStorm.
 * User: MOHSIN SHISHIR
 * Date: 12/28/2015
 * Time: 4:42 PM
 */

namespace Chorki\themes\banners;


use Chorki\Repositories\DbRepositories;

class ThemeBannerRepository extends DbRepositories{


    protected $model;

    function __construct (\ThemeBanner $model)
    {
        $this->model = $model;
    }
    public function moveAndRecordImages($images, $shop_id){
        $old_directory = public_path('img_tmp');
        $old_thumb_directory = $old_directory.'/thumb';
        $new_directory = public_path().'/public_img/shop_'.$shop_id.'/theme/banners';
        $new_thumb_directory = $new_directory.'/thumb';
        if (!folder_exists($new_directory)) {
            mkdir( $new_directory, 0777, true );
        }
        if ( !folder_exists($new_thumb_directory) ) {
            mkdir( $new_thumb_directory, 0777, true );
        }
       // dd($images);
        foreach($images as $old_file_name){
            $new_file_name = $shop_id.'_'.$old_file_name;
            if (rename($old_directory.'/'.$old_file_name , $new_directory.'/'.$new_file_name )
                && rename($old_thumb_directory.'/'.$old_file_name, $new_thumb_directory.'/'.$new_file_name)){
                $this->model->create(['name'=>$new_file_name,'shop_id'=>$shop_id]);

            }
        }
    }
}