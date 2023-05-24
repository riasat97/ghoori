<?php

class Tag extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['tagName'];

    public function products() {
        return $this->belongsToMany('Product', 'product_tag','tag_id','product_id');
    }
    public function category()
    {
        return $this->belongsTo('Category');
    }

}