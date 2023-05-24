<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 5/9/2015
 * Time: 6:01 PM
 */

namespace Chorki\Repositories;


abstract class CartRepositories {

    public function getAll() {
        return $this->model->all();
    }


    public function getById($id) {
        return $this->model->findOrFail($id);
    }

    public function getBySlug($slug) {
        return $this->model->where('slug', '=', $slug)->first();
    }
    public function save(array $input){
       return  $this->model->create(['shop_id'=>$input['shop_id'],'product_id'=>$input['product_id']]);
    }
}