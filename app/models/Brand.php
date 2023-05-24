<?php

class Brand extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['brandName'];




    public function products(){
        return $this->hasMany('Product','brand_id');
    }



}