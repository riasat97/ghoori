<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/18/2015
 * Time: 11:44 AM
 */

namespace Chorki\banners\Models;


use Chorki\Repositories\DbRepositories;

class BannerRepositoryDb extends DbRepositories implements BannerRepositoryInterface{

    protected $model;

    function __construct(Banner $model)
    {
        $this->model = $model;
    }
}