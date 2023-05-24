<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 8/3/2015
 * Time: 2:53 PM
 */

namespace Chorki\Validators\OwnShippingChannel;


use Chorki\Validators\FormValidator;
use Fadion\ValidatorAssistant\ValidatorAssistant;

class OwnShippingChannelValidator extends ValidatorAssistant{
    protected $rules = [
        'unitCost[*]'=>  'required|numeric|min:0',
        'shippingLocation_id[*]'=>'required'
    ];
    protected $messages = array(
        'unitCost[*].required' => 'The BDT/KG field is required.',
        'shippingLocation_id[*].required'=>'The Location field is required'
    );

}