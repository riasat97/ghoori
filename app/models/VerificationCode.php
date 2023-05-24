<?php

class VerificationCode extends \Eloquent {

    // Add your validation rules here
    public static $rules = [
        // 'title' => 'required'
    ];

    // Don't forget to fill this array
    protected $fillable = ['code','shop_id','attempt'];

    protected $table = 'verificationcodes';


    public function shop(){
        return $this->belongsTo('Chorki\shops\Models\Shop');
    }

}