<?php

class FacebookShop extends \Eloquent {
    protected $table = 'facebookshops';
	protected $fillable = ['shop_id','page_id','page_access_token','app_id'];

    public function fbShopLogs(){
        return $this->hasMany('FbShopLog','facebookShop_id');
    }
    public function shop(){
        return $this->belongsTo('Chorki\shops\Models\Shop');
    }
    public static function shopHasFbShop($shopId){
        $res = self::where('shop_id', '=', $shopId)->first();
        return $res? true : false ;
    }

    public static function pageHasFbShop($pageId){
        $res = self::where('page_id', '=', $pageId)->first();
        return $res? true : false ;
    }

    public static function getFbShopByPageId($pageId){
        $res = self::where('page_id', '=', $pageId)->first();
        return $res;
    }
}