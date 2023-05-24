<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 5/6/15
 * Time: 8:25 PM
 */

namespace Chorki\SMS;


class MuthoFunSMSSender extends SMSSender{

    protected function senderSpecificSendSMS($number,$message,$originator){

        $url = 'http://manage.muthofun.com/bulksms/bulksend.go';
        $userName = 'nazmus.saquibe@chorki.com';
        $password = 'NE4bkyHAAC6m';
        $message = urlencode($message);

        $requestUrl =   $url.
                        "?username=$userName".
                        "&password=$password".
                        "&originator=$originator".
                        "&phone=$number".
                        "&msgtext=$message";

        $response = file_get_contents($requestUrl);
        return $response;
    }
}