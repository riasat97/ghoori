<?php
/**
 * Created by Sublime 3.
 * User: Biswajit
 * Date: 1/7/15
 * Time: 4:35 PM
 */

namespace Chorki\SMS;


class DozeSmsSender extends SMSSender{

    protected function senderSpecificSendSMS($number,$message,$originator){

        $url = 'http://sms.doze.my/send.php';
        $userName = 'sms2@chorki.com';
        $password = 'jVNMGYG8';
        // $message = utf8_encode($message);
        $message = urlencode( utf8_encode($message) );

        $requestUrl =   $url.
                        "?username=$userName".
                        "&password=$password".
                        "&mask=$originator".
                        "&destination=$number".
                        "&body=$message";
        $response = file_get_contents($requestUrl);
        return $response;
    }
}