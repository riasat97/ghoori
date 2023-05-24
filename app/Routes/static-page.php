<?php
/**
 * Static page route
 */

Route::get('about-us', array('as' => 'about-us', 'uses' => 'StaticPageController@getAboutUs'));
Route::get('faq', array('as' => 'faq', 'uses' => 'StaticPageController@getFAQ'));
Route::get('get-started', array('as' => 'store.getStarted', 'uses' => 'StaticPageController@getStarted'));
Route::get('terms-and-conditions', array('as' => 'store.getTerms', 'uses' => 'StaticPageController@getTerms'));
Route::get('privacy-policy', array('as' => 'store.getPrivacy', 'uses' => 'StaticPageController@getPrivacies'));
Route::get('price', array('as' => 'pricing', 'uses' => 'StaticPageController@getPricing'));
Route::get('fshop', array('as' => 'fshop', 'uses' => 'StaticPageController@getFshop'));
Route::get('features', array('as' => 'store.getFeatures', 'uses' => 'StaticPageController@getFeatures'));
Route::post('/contactus', array('as' => 'store.contactUsAjax', 'uses' => 'StaticPageController@contactUsAjax'));

//Photography Package
Route::get('photography', array('as' => 'photography', 'uses' => 'StaticPageController@photographyPackage'));