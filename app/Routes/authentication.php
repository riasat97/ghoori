<?php
/**
 *  SignUp, Login, Logout routes
 */
Route::get('login', array('uses'=>'SignUpController@showFbLogin','as'=>'login.show'));
Route::get('logout',array('as'=>'logout','uses'=>'SignUpController@logout'));
Route::post('ajaxFbLogin',array('as'=>'ajaxFbLogin', 'uses'=>'SignUpController@ajaxFbLogin'));
Route::get('userLoginStatus',array('as'=>'userLoginStatus', 'uses'=>'SignUpController@userLoginStatus'));
Route::post('emailSignUp',array('as'=>'emailSignUp','uses'=>'SignUpController@emailSignUp'));
Route::post('emailLogin',array('as'=>'emailLogin','uses'=>'SignUpController@emailLogin'));

/**
 *
 */