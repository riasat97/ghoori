<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/14/2015
 * Time: 5:01 PM
 */

namespace Chorki\Validators\Product;


use Chorki\Validators\FormValidator;

class ProductValidator extends FormValidator{

    public static $rules = [
        'name' => 'required|max:100',
        'description' => 'required|max:1000',
        'price' => 'required|numeric|min:1',
        'category_id'=>'integer',
        'subcategory_id' =>'integer',
        'subSubCategory_id' => 'integer',
        'shop_id' => 'integer',
        'stock'=>'required|integer|min:0',
        'weight'=>'required|numeric',
        'weightunit'=>'required',
        'images'=>'required'
    ];
}