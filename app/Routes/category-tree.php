<?php
/**
 * Created by PhpStorm.
 * User: Insp5458
 * Date: 10/5/2015
 * Time: 12:41 AM
 */

Route::get('categorytreebyid/{shopID}',array('as'=>'categorytreebyid','uses'=>'CategoriesController@getCategoriesByID'));