<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/12/2016
 * Time: 4:47 PM
 */

namespace Chorki\PreOrders;


interface PreOrderRepositoryInterface
{
    public function getAll();
    public function getById($preOrderId);
    public function getBySlug($slug);
    public function savePreOrder();
    public function createPackage();
    public function editPreOrderContent($slug,$preorder_id);
    public function updatePreOrder();
    public function deletePreorder($slug,$preorder_id);
    public function preorderDetails($slug,$preOrderId);
    public function getPreOrder($slug);
    public function showPreorder($slug);

}