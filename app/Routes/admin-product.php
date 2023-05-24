<?php
/**
 * ProductsController
 */

Route::group(array('before' => 'auth'), function(){
    //@todo more unused routes can be here ie: uploadImage
    Route::post('products/post', array('as'=>'products.post','uses'=>'ProductsController@post'));
    Route::get('products/tagDropdown', array('as'=>'tagDropdown','uses'=>'ProductsController@tagDropdown'));
    Route::get('products/categoryDropDown', array('as'=>'categoryDropDown','uses'=>'ProductsController@categoryDropDown'));
    Route::get('products/subCategoryDropDown', array('as'=>'subCategoryDropDown','uses'=>'ProductsController@subCategoryDropDown'));
    Route::get('products/subSubCategoryDropDown', array('as'=>'subSubCategoryDropDown','uses'=>'ProductsController@subSubCategoryDropDown'));

    Route::post('products/move-category', array('as' => 'moveCategory', 'uses' => 'ProductsController@moveCategory' ));
    Route::get('products/getJson', array('as' => 'getJson', 'uses' => 'ProductsController@getJson' ));
    Route::get('products/edit/{productId}', array('as' => 'getEdit', 'uses' => 'ProductsController@getEdit' ));
    Route::post('products/edit', array('as' => 'postEdit', 'uses' => 'ProductsController@edit' ));
    Route::get('products/status', array('as' => 'products.status', 'uses' => 'ProductsController@changeProductStatus' ));
    Route::post('products/uploadImage', array('as' => 'uploadProductImage', 'uses' => 'ProductsController@postProductImage' ));
    Route::resource('products', 'ProductsController',array('only' => array( 'update','destroy')));
});
Route::get('products/getproductsbycategories', array('as' => 'getproductsbycategories', 'uses' => 'ProductsController@getProductsByCategories' ));
Route::get('shops/{slug}/products/{id}', array('as' => 'products.view', 'uses' => 'ProductsController@show' ));
Route::get('products/related',array('as'=>'relatedProducts','uses'=>'ProductsController@getRelatedProducts'));

