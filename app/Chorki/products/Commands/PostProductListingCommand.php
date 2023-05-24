<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/10/2015
 * Time: 4:28 PM
 */

namespace Chorki\products\Commands;


class PostProductListingCommand {


    public $name;
    public $description;
    public $price;
    public $category_id;
    public $subcategory_id;
    public $subSubCategory_id;
    public $shop_id;
    public $stock;
    public $weight;
    public $weightunit;


    public function __construct
    ( $name,$description,$price,$category_id,$subcategory_id,$subSubCategory_id,$stock,$weight,$weightunit,$shop_id
    )
    {
        $this->name=$name;
        $this->description = $description;
        $this->price = $price;
        $this->category_id = $category_id;
        $this->subcategory_id = $subcategory_id;
        $this->subSubCategory_id = $subSubCategory_id;
        $this->stock = $stock;
        $this->weight = $weight;
        $this->weightunit = $weightunit;
        $this->shop_id = $shop_id;
    }



}