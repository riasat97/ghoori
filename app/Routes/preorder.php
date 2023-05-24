<?php



Route::group(array('before' => 'auth'), function() {
        Route::group(array('prefix' => 'admin','before' => 'owner'), function(){
                Route::get('shops/{slug}/preorder-products', array('as' => 'shops.preorder', 'uses' => 'PreorderController@getPreOrder' ));
                Route::get('shops/{slug}/preorders', array('as' => 'shops.preorderlist', 'uses' => 'PreorderController@getAllOrders' ));
                Route::post('/save-preorder',array('as'=>'save-preorder','uses'=>'PreorderController@savePreOrder'));
                Route::get('/create-package',array('as'=>'create-package','uses'=>'PreorderController@createPackage'));
                Route::post('/save-package',array('as'=>'save-package','uses'=>'PreorderController@savePackage'));
                Route::post('/save-preorder-image',array('as'=>'save-preorder-image','uses'=>'PreorderController@savePreOrderImage'));
                Route::get('shops/{slug}/preorder/{id}/edit', array('as' => 'shop.preorder.edit', 'uses' => 'PreorderController@editPreOrderContent'));
                Route::get('shops/{slug}/packages/{id}/edit', array('as' => 'shop.package.edit', 'uses' => 'PreorderController@editPackage'));
                Route::post('/update-preorder-package',array('as'=>'update-preorder-package','uses'=>'PreorderController@updatePackage'));
                Route::post('/update-preorder',array('as'=>'update-preorder','uses'=>'PreorderController@update_preorder'));
                Route::get('shops/{slug}/package/{id}/delete',array('as'=>'shop.package.delete','uses'=>'PreorderController@deletePackage'));
                Route::get('shops/{slug}/preorder/{id}/delete',array('as'=>'shop.preorder.delete','uses'=>'PreorderController@deletePreorder'));
                Route::get('shops/{slug}/preorder/{id}/details',array('as'=>'preorder.admin.details','uses'=>'PreorderController@preorderDetails'));
                Route::get('shops/{slug}/preorder/{id}/checkout',array('as'=>'preorder.checkout','uses'=>'PreorderController@preorderCheckout'));
                Route::get('shops/{slug}/preorder/{id}/order-store',array('as'=>'preorder.order.store','uses'=>'PreorderController@preorderCheckout'));
                Route::get('shops/{slug}/package/{preorder_key}/{preorder_id}/add',array('as'=>'shop.package.add','uses'=>'PreorderController@addPackage'));
        });
});

Route::get('shops/{slug}/preorder',array('as'=>'store.preorder.show','uses'=>'PreorderController@showPreorder'));

Route::get('shops/{slug}/preorder/{id}/checkout',array('as'=>'preorder.checkout','uses'=>'PreorderController@preorderCheckout'));
Route::get('shops/{slug}/preorder/{id}/order-store',array('as'=>'preorder.order.store','uses'=>'PreorderController@preorderCheckout'));


//Route::get('shops/get-package',array('as'=>'preorders.getShippingPackages','uses'=>'PreorderController@getShippingPackages'));
Route::post('shops/preorder/paymenturl',array('as'=>'preorder.geturl','uses'=>'PreorderController@savePreBookOrder'));

// Route::post('/save-preorder',array('as'=>'save-preorder','uses'=>'PreorderController@savePreOrder'));
// Route::get('/create-package',array('as'=>'create-package','uses'=>'PreorderController@createPackage'));
 Route::post('/save-package',array('as'=>'save-package','uses'=>'PreorderController@savePackage'));
// Route::post('/save-preorder-image',array('as'=>'save-preorder-image','uses'=>'PreorderController@savePreOrderImage'));
// Route::post('/save-preorder-image-testing',array('as'=>'save-preorder-image-testing','uses'=>'PreorderController@savePreOrderImage'));
// Route::get('shops/{slug}/packages/{id}/edit', array('as' => 'shop.package.edit', 'uses' => 'PreorderController@editPackage'));

Route::post('/update-preorder-package',array('as'=>'update-preorder-package','uses'=>'PreorderController@updatePackage'));

// Route::post('/update-preorder',array('as'=>'update-preorder','uses'=>'PreorderController@update_preorder'));
//Route::post('/update-preorder-image',array('as'=>'update-preorder-image','uses'=>'PreorderController@update_preorder_image'));

Route::get('shops/{slug}/preorder/{id}/details',array('as'=>'preorder.details','uses'=>'PreorderController@preorderDetails'));
Route::post('/preorder-login',array('as'=>'preorder-login','uses'=>'PreorderController@check_user_login')); /*deprecated*/
Route::get('packages/status', array('as' => 'packages.status', 'uses' => 'PreorderController@changePackageStatus' ));
Route::get('preorders/{prebookorderId}/proceed',array('as'=>'preorders.proceed','uses'=>'PreorderController@getpreorderToProceed'));
Route::get('preorders/{prebookorderId}/order-details',array('as'=>'preorders.orderDetail','uses'=>'PreorderController@getpreorderDetails'));
Route::post('preorders/reject',array('as'=>'preorders.reject','uses'=>'PreorderController@getPreorderToReject'));




