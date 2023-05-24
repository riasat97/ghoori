<?php
Route::when('*', 'mycsrf', array('post', 'put', 'delete'));

Debugbar::disable();
// Debugbar::enable();

//show raw query uncomment if needed :)
/*Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});*/
// DB::listen( function($sql){
//     var_dump($sql);
// });

Route::get('/', array('as'=>'home','uses'=>'HomeController@getHome'));
Route::get('/market', array('as'=>'market','uses'=>'PublicShopController@getIndex2'));
Route::get('/allproducts', array('as'=>'homeproducts','uses'=>'HomeController@getProducts'));
Route::post('/moreproducts', array('as'=>'morehomeproducts','uses'=>'HomeController@getMoreProducts'));
Route::post('/group', array('as'=>'homegroup','uses'=>'HomeController@getHomeGroup'));
Route::get('/deals', array('as'=>'deals','uses'=>'HomeController@getDealsPage'));
Route::get('/dhakafoodies', array('as'=>'dhakafoodies','uses'=>'HomeController@getDFDealsPage'));
Route::post('/moredeals', array('as'=>'moredeals','uses'=>'HomeController@getSomeDeals'));


Route::get('/poa12', array('as'=>'poabaropageeng','uses'=>'HomeController@getPoaBaroPage'));
Route::post('/morepoa12', array('as'=>'morepoabaro','uses'=>'HomeController@getMorePoaBaro'));
Route::get('/পোয়া১২', array('as'=>'poabaropage','uses'=>'HomeController@getPoaBaroPage'));
Route::post('/savereg', array('as'=>'savepoabaro','uses'=>'HomeController@savePoaBaroReg'));


Route::get('/search', array('as' =>  'search', 'uses' => 'SearchController@index'));