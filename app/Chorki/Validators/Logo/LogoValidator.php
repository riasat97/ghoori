<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/18/2015
 * Time: 11:47 AM
 */

namespace Chorki\Validators\Logo;


use Chorki\Validators\FormValidator;

class LogoValidator extends FormValidator{

    public static $rules = [
        'logo'=>  'required|image|mimes:jpeg,bmp,png'
    ];
}