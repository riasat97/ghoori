<?php
/*Cart Management*/
Route::post('carts/update-cart',array('as'=>'carts.updateCart','uses'=>'CartsController@updateCart'));
Route::get('carts/delete',array('as'=>'carts.remove','uses'=>'CartsController@remove'));
Route::get('carts/destroy/{rowId}',array('as'=>'carts.delete','uses'=>'CartsController@delete'));
Route::get('carts/storecart',array('as'=>'carts.storecart','uses'=>'CartsController@store'));
Route::post('carts/buy-now',array('as'=>'carts.buyNow','uses'=>'CartsController@getBuyNow'));
Route::resource('carts', 'CartsController');