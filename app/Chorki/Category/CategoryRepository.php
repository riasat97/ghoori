<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 1/3/2016
 * Time: 3:47 PM
 */

namespace Chorki\Category;


use Chorki\Repositories\DbRepositories;

class CategoryRepository extends DbRepositories{

    protected $model;

    function __construct(\Category $model)
    {

    $this->model = $model;
    }
    public function getByName($category){
      return  $this->model->where('name',$category)->first();
    }


}