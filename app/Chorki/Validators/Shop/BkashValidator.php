<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 10/29/2015
 * Time: 7:49 PM
 */

namespace Chorki\Validators\Shop;


use Fadion\ValidatorAssistant\ValidatorAssistant;

class BkashValidator extends ValidatorAssistant{
    protected $rules = [
        'name'=>  'required',
        'mobile'=>array('required','regex:/^([+]?88)?01[15-9]\d{8}$/'),
        'type'=>'required',

    ];
    protected $messages = array(

    );
}