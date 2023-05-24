<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/18/2015
 * Time: 11:44 AM
 */

namespace Chorki\banners\Models;


interface BannerRepositoryInterface {

    public function getAll();
    public function getById($bannerId);
    public function getBySlug($slug);
}