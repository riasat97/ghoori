<?php

class Category extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name','parent_id'];

    public function products(){
        return $this->hasMany('Product');
    }
    public function tags(){
        return $this->hasMany('Tag');
    }
    public function subcategories(){
        return $this->hasMany('Subcategory');
    }


}