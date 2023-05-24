<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 5/6/15
 * Time: 7:16 PM
 */

namespace Chorki\SMS;

use Exception;
use Log as Log;

abstract class SMSSender{
    //@todo throw exception directly from the validation

    protected $max_msg_size = 160;

    protected abstract function senderSpecificSendSMS($number,$message,$originator);

    protected function validNumber($number){
        if(preg_match('/^([+]?88)?01[15-9]\d{8}$/',$number)){
            return true;
        }
        return false;
    }

    protected function validMessage($message){
        if(strlen($message)<=160){
            return true;
        }
        return false;
    }

    protected function validOriginator($originator){
        if(strlen($originator)<=11){
            return true;
        }
        return false;
    }

    protected function validateAll($number,$message,$originator){
        if(!$this->validNumber($number)){
            throw new Exception('Invalid Number');
        }

        if(!$this->validOriginator($originator)){
            throw new Exception('Invalid Originator');
        }

        if(!$this->validMessage($message)){
            throw new Exception('Invalid Message');
        }
    }

    public function sendSMS($number,$message,$originator){

        try {
            $this->validateAll($number,$message,$originator);
        } catch (Exception $e) {
            Log::error('sms validation failed', ['number' => $number,'message' => $message]);
        }

        $number = preg_replace('/^([+]?88)?/', '', $number);
        // $number = '+88'.preg_replace('/^([+]?88)?/', '', $number);
        try {
            return $this->senderSpecificSendSMS($number,$message,$originator);
        } catch (Exception $e) {
            Log::error('SMS GATEWAY DOWN!', ['number' => $number,'message' => $message]);
        }
        
    }
}