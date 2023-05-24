<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 5/2/2015
 * Time: 2:43 PM
 */

namespace Chorki\Validators\Shop;


use Chorki\Validators\FormValidator;

class AddressValidator extends FormValidator{

    public static $rules=[
        'address'=>'required|max:160',
        'email'=>'required|email',
        'mobile'=>array('required','regex:/^([+]?88)?01[15-9]\d{8}$/')
    ];
}