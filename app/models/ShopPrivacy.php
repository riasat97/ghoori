<?php

class ShopPrivacy extends \Eloquent {

    // Add your validation rules here
    public static $rules = [
        // 'title' => 'required'
    ];
    protected $table = 'shopprivacies';
    // Don't forget to fill this array
    protected $guarded = [];
    public function shop(){
        return $this->belongsTo('Chorki\shops\Models\Shop');
    }

}