<?php
/**
 * Created by PhpStorm.
 * User: Insp5458
 * Date: 10/8/2015
 * Time: 7:07 PM
 */

namespace Chorki\Validators\Order;


use Chorki\Validators\FormValidator;
use Fadion\ValidatorAssistant\ValidatorAssistant;

class OrderRejectionReasonValidator extends ValidatorAssistant{

    protected $rules=[

        'order_id' => 'required',
        'rejectionreason_id' => 'required_without:others',
        'others'=>'required_without:rejectionreason_id',
        'reason' => 'required_with:others|max:200',
    ];
    protected $messages = array(
        'rejectionreason_id.required_without' => 'Please check one of the reasons or select other reasons',
        'others.required_without'=>'Please Write down your reason if you do not check above options '
    );
}