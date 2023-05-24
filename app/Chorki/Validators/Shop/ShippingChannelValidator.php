<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 11/9/2015
 * Time: 4:28 PM
 */

namespace Chorki\Validators\Shop;


use Fadion\ValidatorAssistant\ValidatorAssistant;

class ShippingChannelValidator extends ValidatorAssistant{

    protected $rules = [
        'shippingChannel_id' => 'required_without:ownChannel',
        'ownChannel'=>  'required_without:shippingChannel_id',

    ];
    protected $messages = array(
        'shippingChannel_id.required_without' => 'Please check one of the shipping methods or choose own delivery system.',
        'ownChannel.required_without'=>'Choose own delivery system or One of the shipping methods listed above'
    );
}