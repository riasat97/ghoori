<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/13/2016
 * Time: 12:49 PM
 */

namespace Chorki\PreOrders\Packages;


interface PackageRepositoryInterface
{
    public function getAll();
    public function getById($preOrderPackageId);
    public function getBySlug($slug);
    public function savePackage();
    public function editPackage($slug,$preorder_key);
    public function updatePackage();
    public function deletePackage($slug,$preorder_package_id);
    public function getPackages($preorder_key);

}