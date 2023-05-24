<?php
/**
 * Created by PhpStorm.
 * User: MOHSIN SHISHIR
 * Date: 12/23/2015
 * Time: 12:45 PM
 */

    Route::get('theme', 'ThemeController@themeHome');
    Route::get('category', 'ThemeController@themeCategory');
    Route::get('product', 'ThemeController@themeProduct');

//    Meghdut Theme Related Routes
    Route::get('shops/{slug}/{category}', array('as' => 'shops.category',
               'uses' => 'ThemeController@getProductsByCategory'));
    Route::get('shops/{slug}/search/products', array('as' => 'search.category',
    'uses' => 'ThemeController@getSearchProductsByCategory'));



//    Dhumketu Theme Related Routes


//    Route::get('product', array('as' => 'getSingleProduct',
//        'uses' => 'DhumketuThemeController@getProduct'));

//    Route::get('theme/dhumketu', 'DhumketuThemeController@dhumketuHome');
//    Route::get('theme/dhumketu/products', 'DhumketuThemeController@dhumketuProduct');

//  Chayaneer Theme Related Routes
//    Route::get('theme/chayaneer', 'ChayaneerThemeController@chayaneerHome');



