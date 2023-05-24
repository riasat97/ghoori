<?php
/**
 * Created by PhpStorm.
 * User: biswajit
 * Date: 12/15/15
 * Time: 2:15 PM
 */

namespace Chorki\SMS\SmartSms;


use Chorki\SMS\SMSSender;

class Config extends SMSSender
{
    protected function senderSpecificSendSMS($number,$message,$originator) {
        $url = 'http://smartsms.co/api/send?';
        $api_key = 'd7bc1ebd188323e21a2539d4dde4d054';
        $sender = "GHOORI";

        $message = urlencode($message);

        $requestUrl = $url.
            "api_key=$api_key".
            "&contact=$number".
            "&sender=$sender".
            "&sms=$message";
        try {
            $response = $this->SendNow($requestUrl);
        } catch (Exception $e) {
            $response = false;
        }
        return $response;
    }
    protected function SendNow($requestUrl) {
        $response = @file_get_contents($requestUrl);
        if ($response === FALSE) {
            throw new Exception("Cannot access '$path'.");
        } else {
            return $response;
        }
    }
}