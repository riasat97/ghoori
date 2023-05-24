<?php

/** Route Partial Map
=================================================== */

// ORDER MATTERS!
$route_partials = [

    // Global: Filters, Patterns
    'global',
    'category-tree',
    'admin-shop',
    'admin-product',
    'cart',
    'authentication',
    'test-route',
    'static-page',
    'public-shop',
    'fb-shop',
    'utility',
    'deprecated',
    'preorder',
    'custom-shop'


];

/** Route Partial Loadup
=================================================== */

foreach ($route_partials as $partial) {

    $file = __DIR__.'/Routes/'.$partial.'.php';

    if ( ! file_exists($file))
    {
        $msg = "Route partial [{$partial}] not found.";
        throw new \Illuminate\Filesystem\FileNotFoundException($msg);
    }

    require $file;
}

/**
 * previews sequence as follows
 */

/**
 * global
 */
/**
 * category tree route
 */

/**
 * ShopsController and others @todo remove the other classes
 */

/**
 * Cart Management
 */

/**
 * PublicShopController
 */

/**
 * ProductsController
 */

/**
 *  SignUp, Login, Logout routes
 */
/**
 *  FBshop public routes
 */
/**
 * deprecated route
 */


/**
 * Static page route
 */


Route::controller('password', 'RemindersController');

/**
 * Sponsored Items routes
 */

Route::group(array('prefix' => 'sponsored-items','before'=>'auth'), function()
{
    Route::post('get-occupied-dates',array('as'=>'get-occupied-dates','uses'=>'SponsoredItemsController@getOccupiedDates'));
});

Route::get('bkash-transaction/{transaction_token}',array('as'=>'bkash-input','uses'=>'PaymentController@bKashTransactionIdInput'));
Route::post('bkash-transaction/{transaction_token}',array('as'=>'bkash-process','uses'=>'PaymentController@bKashTransactionProcess'));
Route::get('make-payment/{transaction_type}/{payment_token}',array('as'=>'make-payment','uses'=>'PaymentController@redirectToPaymentURL'));
Route::get('payment-ack/{payment_token}',array('as'=>'payment-ack','uses'=>'PaymentController@showAcknowledgement'));
//Theme testing route