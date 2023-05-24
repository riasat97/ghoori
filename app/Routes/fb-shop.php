<?php
/**
 * Created by PhpStorm.
 * User: Insp5458
 * Date: 10/5/2015
 * Time: 12:54 AM
 */
Route::match(['GET','POST'],'fbShop/myFbShop',array('as'=>'fbShop.myShop', 'uses'=>'FacebookShopController@myFbShop'));