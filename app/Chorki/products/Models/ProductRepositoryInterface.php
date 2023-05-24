<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/15/2015
 * Time: 3:47 PM
 */

namespace Chorki\products\Models;



interface ProductRepositoryInterface
{

    public function getAll();

    public function getById($productId);

    public function getBySlug($slug);

    public function save(Product $product);

    public function getPublishedByPage($shop_id, $page = 1, $limit = 20,$shopProductLimit = 24);

    public function getByPage($shop_id, $page = 1, $limit = 20);

    public function totalItemsForShop($slug);

    public function totalPublishedItemsForShop($slug,$productLimit);

    public function processWeight($weight, $weightUnit);

    public function getAllNewestProducts();

    public function getHighestViewedProducts();

    public function getHighestSoldProducts();

    public function ProductHasGpCampaign($product);

    public function viewCount($product);

    public function getRelatedProducts($data);
}