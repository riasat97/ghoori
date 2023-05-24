<?php

class ProductImage extends \Eloquent {

    protected static $rules = [];
    protected $fillable = ['title','imageLink','product_id','tempKey'];

    protected $table = 'images';
    public function product() {
        return $this->belongsTo('Chorki\products\Models\Product');
    }
}