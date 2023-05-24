<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 10/29/2015
 * Time: 5:33 PM
 */

namespace Chorki\Validators\Shop;


use Fadion\ValidatorAssistant\ValidatorAssistant;

class AccountValidator extends ValidatorAssistant{
    protected $rules = [
        'name'=>  'required',
        'accountNo'=>'required',
        'bank'=>'required',
        'branch'=>'required'
    ];
    protected $messages = array(

    );
}