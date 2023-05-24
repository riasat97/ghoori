<?php
/**
 * Created by PhpStorm.
 * User: Insp5458
 * Date: 10/5/2015
 * Time: 12:52 AM
 */
Route::get('/ordermig', array('as' =>  'ordermig', 'uses' => 'OrdersController@migrateOrdersToNewSystem'));


 Route::get('/parcel/{parcelId}', array('as' =>  'parcel', 'uses' => 'OrdersController@parcelInquiry'));

//Route::get('/parcel/{parcelId}', array('as' =>  'parcel', 'uses' => 'OrdersController@parcelInquiry'));