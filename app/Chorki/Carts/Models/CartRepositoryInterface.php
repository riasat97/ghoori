<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 5/9/2015
 * Time: 5:58 PM
 */

namespace Chorki\Carts\Models;


interface CartRepositoryInterface {

    public function getAll();
    public function getById($id);
    public function getBySlug($slug);
    public function save(array $input);
    public function cartAdd(array $input);
    public function cartUpdate($id,array $input);
    public function cartRemove($id);
    public function cartGet($id);
    public function cartContent();
    public function cartDestroy();
    public function cartTotal();
    public function cartCount();
    public function cartSearch(array $input);

}