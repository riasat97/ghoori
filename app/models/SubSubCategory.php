<?php

class SubSubCategory extends Eloquent{
    protected $fillable = [];

    //model relation...

    protected $table = 'subsubcategories';

    public function subCategory(){
        return $this->belongsTo('Subcategory');
    }


}

?>