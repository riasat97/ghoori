<?php

use Illuminate\Support\Facades\DB;

class Attribute extends \Eloquent {
	protected $guarded = [];
    protected $table = 'attributes';

    public function products(){
        return $this->belongsToMany('Chorki\products\Models\Product','product_attribute')->withPivot('value','image');
    }
    public function getProductAttribute($id){
        return DB::table('product_attribute')->where('id',$id)->select('value')->first();
    }
    public function getAttr($id){
        return DB::table('product_attribute')->join('attributes','product_attribute.attribute_id','=','attributes.id')
            ->where('product_id',$id)->select('*','product_attribute.id As productAttributeId')->get();
    }
}