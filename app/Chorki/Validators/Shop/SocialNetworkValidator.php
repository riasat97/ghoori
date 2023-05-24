<?php

namespace Chorki\Validators\Shop;
use Chorki\Validators\FormValidator;

class SocialNetworkValidator extends FormValidator{
    public static $rules=[
        'facebook'=>'sometimes|url',
        'twitter'=>'sometimes|url',
        'youtube'=>'sometimes|url'
    ];
}