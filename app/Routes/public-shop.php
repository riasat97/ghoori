<?php
/**
 * PublicShopController
 */

Route::get('shops', array('as' => 'store.index', 'uses' => 'PublicShopController@getAllShops'));
Route::get('shops/{slug}', array('before' => 'verify-shop','as' => 'store.shops', 'uses' => 'PublicShopController@getShop'));
Route::get('shops/{slug}/about-shop',array('as'=>'store.about.show','uses'=>'PublicShopController@showAbout'));
Route::get('shops/{slug}/privacy-policy',array('as'=>'store.privacy.show','uses'=>'PublicShopController@showPrivacy'));
Route::get('shops/{slug}/terms-and-conditions',array('as'=>'store.term.show','uses'=>'PublicShopController@showTerm'));