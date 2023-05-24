<?php
//ecourier parcel id ECR000605587
Route::get('test',array('as'=>'test','uses'=>'TestController@test'));

Route::get('/pdf',array('as'=>'testpdf','uses'=>'TestController@pdf'));
Route::get('/hashmake',array('as'=>'hashmake','uses'=>'TestController@hashmake'));
Route::get('/hashmake/{string}',array('as'=>'hashmake','uses'=>'TestController@hashmake'));
Route::post('testPost',array('as'=>'test-post','uses'=>'TestController@testPost'));

Route::get('top-10',function(){
 $cart=   DB::table('carts')
    ->join('products','carts.product_id','=','products.id')
    ->select('products.id','products.name',DB::raw('count(carts.product_id) as numberOfTimeAddedToCart'))
    ->orderBy('numberOfTimeAddedToCart','desc')
    ->groupBy('carts.product_id')
    ->get();
    dd($cart);

}
);