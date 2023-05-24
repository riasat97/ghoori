<?php
/**
 * Created by PhpStorm.
 * User: Insp5458
 * Date: 10/5/2015
 * Time: 12:56 AM
 */

//Route::get('/store/get-started', array('as' => 'emailSubscription', 'uses' => 'SubscriptionController@emailSubscription'));
Route::post('/get-started/subscribe', array('as' => 'emailSubscriptionPost', 'uses' => 'SubscriptionController@emailSubscriptionPost'));
//Route::get('/store/get-started/subscribe', array('as' => 'subscribe', 'uses' => 'SubscriptionController@subscribe'));
Route::post('/get-started/subscribed', array('as' => 'subscribePost', 'uses' => 'SubscriptionController@subscribePost'));
Route::post('/get-started/subscribed', array('as' => 'gettingStarted', 'uses' => 'SubscriptionController@gettingStarted'));

Event::listen('Chorki.shops.*', 'Chorki\shops\Listeners\ShopsEventListener');//@todo move it into some serviceprovider

Route::get('/shop_email_verification/{emailVerificationCode}',array('as'=>'shopEmailVerification','uses'=>'VerificationController@verifyShopEmail'));
Route::get('/shop_mobile_verification/{mobileVerificationCode}',array('as'=>'shopMobileVerification','uses'=>'VerificationController@verifyShopMobile'));
