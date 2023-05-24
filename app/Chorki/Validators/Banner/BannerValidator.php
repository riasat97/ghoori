<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/18/2015
 * Time: 11:47 AM
 */

namespace Chorki\Validators\Banner;


use Chorki\Validators\FormValidator;

class BannerValidator extends FormValidator{

    public static $rules = [
        'path'=>  'required|image|mimes:jpeg,bmp,png'
    ];
}