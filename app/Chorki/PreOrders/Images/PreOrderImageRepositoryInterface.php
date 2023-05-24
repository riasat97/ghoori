<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/13/2016
 * Time: 1:46 PM
 */

namespace Chorki\PreOrders\Images;


interface PreOrderImageRepositoryInterface
{
    public function getAll();
    public function getById($preOrderId);
    public function getBySlug($slug);
    public function savePreOrderImage();
    public function moveImage($images,$preorder_key);
    public function deleteImage($images);

}