<?php

Route::group(array('before' => 'auth'), function()
{
    Route::get('shops/resend-mobile-verification-code', array('as' => 'shops.resendSms', 'uses' => 'ShopsController@resendMobileVerificationCodeToUser' ));
    Route::get('shops/resend-mail-verification-link', array('as' => 'shops.resendMail', 'uses' => 'ShopsController@resendMailVerificationLinkToUser' ));
    Route::get('categoryTree',array('as'=>'categoryTree','uses'=>'CategoriesController@getCategories'));
    Route::get('shops/status', array('as' => 'shops.status', 'uses' => 'ShopsController@shopStatus' ));
    Route::get('shops/categoryDropDown', array('as'=>'categoryDropDown','uses'=>'ShopsController@categoryDropDown'));
    Route::get('shops/subCategoryDropDown', array('as'=>'subCategoryDropDown','uses'=>'ShopsController@subCategoryDropDown'));
    Route::get('shops/subSubCategoryDropDown', array('as'=>'subSubCategoryDropDown','uses'=>'ShopsController@subSubCategoryDropDown'));
    Route::get('shops/divisionDropdown', array('as'=>'divisionDropdown','uses'=>'ShopsController@divisionDropdown'));
    Route::get('shops/verificationCodeView', array('as' => 'mobileVerificationCodeView', 'uses' => 'ShopsController@getMobileVerificationCodeView'));
    Route::get('shops/verificationCode', array('as' => 'mobileVerificationCode', 'uses' => 'ShopsController@getMobileVerificationCode'));
    Route::post('shops/verificationCode', array('as' => 'mobileVerificationCode.post', 'uses' => 'ShopsController@postMobileVerificationCode'));
    Route::post('shops/uploadLogo', array('as' => 'uploadLogo.post', 'uses' => 'ShopsController@postUploadLogo'));
    Route::post('shops/uploadBanner', array('as' => 'uploadBanner.post', 'uses' => 'ShopsController@postUploadBanner'));
    Route::get('shops/editAddress', array('as' => 'editAddress', 'uses' => 'ShopsController@editAddress'));
    Route::post('shops/updateAddress', array('as' => 'updateAddress', 'uses' => 'ShopsController@updateAddress'));
    Route::get('shops/editShopTitle', array('as' => 'editShopTitle', 'uses' => 'ShopsController@editShopTitle'));
    Route::post('shops/updateShopTitle', array('as' => 'updateShopTitle', 'uses' => 'ShopsController@updateShopTitle'));
    Route::resource('shops', 'ShopsController', array('only' => array('create', 'store')));

    Route::group(array('prefix' => 'admin','before' => 'owner'), function(){
        Route::resource('shops', 'ShopsController', array( 'only' => array('show'), 'names' => array('show' => 'shops.show')));
        Route::get('shops/{slug}', array('as' => 'shops.view', 'uses' => 'ShopsController@view' ));//@todo this route does not work delete 3 months after november 2015
        Route::get('shops/{slug}/products/{id}', array('as' => 'shop.products', 'uses' => 'ShopsController@getProducts'));
        Route::get('shops/{slug}/products/{id}/edit', array('as' => 'shop.products.edit', 'uses' => 'ProductsController@editProduct'));

        /**
         * Page Manager routes
         */
        Route::put('shops/{slug}/settings/own-shipping-channel',array('as'=>'ownShippingChannels.updateChannel','uses'=>'OwnShippingChannelsController@update'));
        Route::resource('ownShippingChannels','OwnShippingChannelsController');

        Route::post('shops/about-shop',array('as'=>'about.post','uses'=>'PagesController@postAbout'));
        Route::get('shops/{slug}/about-shop',array('as'=>'about.show','uses'=>'PagesController@showAbout'));
        Route::post('shops/privacy-policy',array('as'=>'privacy.post','uses'=>'PagesController@postPrivacy'));
        Route::get('shops/{slug}/privacy-policy',array('as'=>'privacy.show','uses'=>'PagesController@showPrivacy'));
        Route::post('shops/terms-and-conditions',array('as'=>'term.post','uses'=>'PagesController@postTerm'));
        Route::get('shops/{slug}/terms-and-conditions',array('as'=>'term.show','uses'=>'PagesController@showTerm'));
        Route::get('shops/{slug}/settings',array('as'=>'settings.edit','uses'=>'SettingsController@edit'));
        Route::put('shops/{slug}/settings/socialNetwork',array('as'=>'settings.updateSocialNetwork','uses'=>'SettingsController@update'));
        Route::put('shops/{slug}/settings/shippingChannels',array('as'=>'settings.updateShippingChannels','uses'=>'SettingsController@postShippingChannels'));
        Route::put('shops/{slug}/settings/paymentMethods',array('as'=>'settings.updatePaymentMethods','uses'=>'SettingsController@postPaymentMethods'));
        Route::post('shops/settings/cupon',array('as'=>'settings.updateCuponSettings','uses'=>'SettingsController@postCuponSettings'));
        Route::post('shops/{slug}/settings/boostPaymentConfirm',array('before' => 'csrf','as'=>'settings.boostPaymentConfirm','uses'=>'SettingsController@boostPaymentConfirm'));
        Route::get('shops/{slug}/settings/{theme}/upload-banner', array('uses' => 'ThemeController@getUploadBanner', 'as' => 'theme.uploadBanner'));
        Route::post('upload-Banner', array('uses' => 'ThemeController@postUploadBanner', 'as' => 'post.theme.uploadBanner'));
        Route::resource('settings','SettingsController');

        Route::post('accounts/post-bkash',array('as'=>'admin.accounts.postBkash','uses'=>'AccountsController@postBkash'));
        Route::resource('accounts','AccountsController');
        /*Order management*/
        Route::get('orders/order-detail',array('as'=>'orders.orderDetail','uses'=>'OrdersController@getOrderDetail'));
        Route::get('orders/order-products',array('as'=>'orders.productList','uses'=>'OrdersController@getOrderProductsByOrderId'));
        Route::get('orders/{orderId}/proceed',array('as'=>'orders.proceed','uses'=>'OrdersController@getOrderToProceed'));
        Route::post('orders/reject',array('as'=>'orders.reject','uses'=>'OrdersController@getOrderToReject'));
        Route::get('shops/{slug}/orders',array('as'=>'orders.all','uses'=>'OrdersController@getAllOrders'));


        /**
         * revenue dashboard
         */
       // Route::get('shops/revenues',array('as'=>'revenues.fetch','uses'=>'RevenuesController@fetch'));
        Route::get('shops/{slug}/revenues',array('as'=>'revenue.index','uses'=>'RevenuesController@index'));
      //  Route::get('shops/{slug}/revenues/orders',array('as'=>'revenues.filteredOrderList','uses'=>'RevenuesController@getFilteredOrderList'));
        Route::get('shops/{slug}/revenues/net-revenues',array('as'=>'revenues.netSalesDetails','uses'=>'RevenuesController@getNetSalesDetails'));
        Route::get('shops/{slug}/revenues/transaction-charges',array('as'=>'revenues.transactionCharges','uses'=>'RevenuesController@getTransactionCharges'));
        Route::get('shops/{slug}/revenues/orders/lifetime',array('as'=>'revenues.LifeTimeRevenueList','uses'=>'RevenuesController@getLifeTimeRevenueList'));

        Route::resource('revenues','RevenuesController');

        /**
         * package
        */
        Route::get('shops/{slug}/package',array('as'=>'package.index','uses'=>'PackagesController@index'));
     //   Route::get('hello',array('as'=>'package.test','uses'=>'PackagesController@test'));
        Route::resource('packages','PackagesController');

        /**
         * Gp campaign routes
         */
        Route::post('shops/{slug}/gp_offer_sep_2015',array('as'=>'gp.sep.15','uses'=>'CampaignController@addGPCampaignToProduct'));
        Route::post('shops/{slug}/winter-is-here',array('as'=>'campaigns.winterIsHere', 'uses'=>'CampaignController@postAddWinterIsHereCampaignToProduct'));
        Route::get('shops/{slug}/gpcampaign2015all',array('as'=>'gp.campaign.all.product','uses'=>'CampaignController@addGPCampaignToAllProductsForMyShop'));

        /**
         * FBshop Routes under prefix admin
         */
        Route::group(array('prefix'=>'shops/{slug}/fbShop'),function(){
            Route::get('create',array('as'=>'fbShop.create','uses'=>'FacebookShopController@create'));
            Route::get('/',array('as'=>'fbShop.index','uses'=>'FacebookShopController@index'));
            Route::post('/',array('as'=>'fbShop.store','uses'=>'FacebookShopController@store'));
            Route::get('edit',array('as'=>'fbShop.edit','uses'=>'FacebookShopController@edit'));
            Route::post('update',array('as'=>'fbShop.update','uses'=>'FacebookShopController@update'));
        });

        /**
         * Sponsored Item routes
         */

        Route::post('shops/{slug}/{product_id}/store-sponsored-item',array('as'=>'store-sponsored-item','uses'=>'SponsoredItemsController@store'));

        /**
         * Photography Routes
         */
        Route::put('shops/{slug}/photography-service-request/{package_id}',array('as'=>'photography-service-request','uses'=>'ProductPhotographyServiceController@placeRequestAndRedirectToPayment'));

        /**
         * shop info update
         */
        Route::put('shops/{slug}/updatetagline', array('as' => 'update_tag_line', 'uses' => 'ShopsController@updateTagLine'));

    });// prefix admin

    Route::get('orders/order-detail',array('as'=>'orders.orderDetail','uses'=>'OrdersController@getOrderDetail'));
    Route::get('my-orders/reject',array('as'=>'myOrders.rejectForm','uses'=>'MyOrdersController@getMyOrderReject'));
    Route::post('my-orders/reject',array('as'=>'myOrders.reject','uses'=>'MyOrdersController@postMyOrderReject'));

    Route::get('edit', array('as'=>'login.edit','uses'=>'SignUpController@edit'));
    Route::put('update',array('as'=>'login.update','uses'=>'SignUpController@update'));
    /*Check Out managemnt*/
    Route::get('orders/shippingPackages',array('as'=>'orders.getShippingPackages','uses'=>'OrdersController@getShippingPackages'));
    Route::get('orders/{shopId}/checkout',array('as'=>'orders.addOrder','uses'=>'OrdersController@getAddOrder'));
    Route::get('orders/{orderId}/verify',array('as'=>'orders.verify',
               'uses'=>'MyOrdersController@getOrderMobileVerificationCodeView'));
    Route::post('orders/{orderId}/verify',array('as'=>'orders.verify',
                'uses'=>'MyOrdersController@postOrderMobileVerificationCode'));
    Route::get('orders/resend-sms', array('as' => 'orders.resendSms',
              'uses' => 'MyOrdersController@resendOrderMobileVerificationCodeToUser' ));
    Route::get('orders/cuponValidity',array('as'=>'orders.cuponValidity','uses'=>'OrdersController@getCuponValidity'));

    Route::get('orders/parcel-inquiry',array('as'=>'orders.parcelInquiry','uses'=>'OrdersController@getParcelInquiry'));
    Route::get('orders/order-history',array('as'=>'orders.myOrder','uses'=>'MyOrdersController@getMyOrders'));
    Route::resource('orders','OrdersController');

    Route::group(array('prefix' => 'easy-pay-way'),function(){
        Route::post('shopper-payment/{shopId}/{status}',array('as'=>'easypayway.shopper','uses'=>'OrdersController@epwTransaction'));
    });

    Route::get('doze-payment/{shopId}/{status}',array('as'=>'doze.payment','uses'=>'OrdersController@dozeTransaction'));

    Route::get('settings',array('as'=>'user.settings','uses'=>'UsersController@userSettings')); //Edit user profile
    Route::post('settings',array('as'=>'user.settings.update','uses'=>'UsersController@updateUserSettings'));
    Route::post('settings/ajaxFbConnect',array('as'=>'user.settings.fb-connect','uses'=>'UsersController@fbConnect'));
});
Route::get('migrate-pending-packages',['uses'=>'PackageMigrationController@postMigrateAllPendingPackagesToAcceptedStatus','as'=>'migratePendingPackages']);
Route::get('update-accepted-at',['uses'=>'PackageMigrationController@postUpdateAcceptedPackagesAcceptedAtDate','as'=>'updateAcceptedAt']);

Route::resource('migrate-packages','PackageMigrationController');

Route::get('general-orders/revert-stock',array('as'=>'general-orders.postRevertStock','uses'=>'GeneralOrdersController@postRevertStockForTemporaryOrders')); //Edit user profile
Route::resource('general-orders','GeneralOrdersController');

Route::get('invoice/{shopId}',['uses'=>'InvoicesController@getDownLoadInvoice','as'=>'downloadInvoice']);
Route::get('invoice-mail/{shopId}',['uses'=>'InvoicesController@sentMailWithInvoice','as'=>'mailInvoice']);
Route::get('generate-invoices',['uses'=>'InvoicesController@getGenerateInvoice','as'=>'generateInvoice']);
Route::resource('generate-invoice','InvoicesController');

Route::get('orders/order-detail',array('as'=>'orders.orderDetail','uses'=>'OrdersController@getOrderDetail'));
Route::get('generate-reports',['uses'=>'ReportsController@getReports','as'=>'generateReports']);
Route::get('generate-report-details',['uses'=>'ReportsController@getReportDetails','as'=>'generateReportDetails']);
Route::get('reports',['uses'=>'ReportsController@getReportView','as'=>'reportView']);
