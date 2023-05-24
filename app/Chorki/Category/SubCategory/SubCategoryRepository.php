<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 1/3/2016
 * Time: 3:48 PM
 */

namespace Chorki\Category\SubCategory;


use Chorki\Repositories\DbRepositories;

class SubCategoryRepository extends DbRepositories{

    protected $model;

    function __construct(\Subcategory $model)
    {
        $this->model = $model;
    }
    public function getByName($subCategory){
        return  $this->model->where('name',$subCategory)->first();
    }
}