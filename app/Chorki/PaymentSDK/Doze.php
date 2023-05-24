<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 12/7/15
 * Time: 7:55 PM
 */

namespace Chorki\PaymentSDK;

use Illuminate\Support\Facades\Config;

class Doze {

    protected  $client;//Guzzle

    protected $paymentUrl,$appId,$appPass,$cmdId,$serviceId,$ano,$bno;

    public function __construct(\GuzzleHttp\Client $client){
        $this->client = $client;
        $this->paymentUrl = Config::get('doze-payment.paymentUrl');
        $this->appId = Config::get('doze-payment.appId');
        $this->appPass = Config::get('doze-payment.appPass');
        $this->cmdId = Config::get('doze-payment.cmdId');
        $this->serviceId = Config::get('doze-payment.serviceId');
        $this->ano = Config::get('doze-payment.ano');
        $this->bno = Config::get('doze-payment.bno');
    }
    public function getLoginUrl($token,$successUrl,$failUrl){
        $base_url = 'http://www.dozeinternet.com/API/login.html';
        $query_params = array(
            'token'=>$token,
            'success'=>$successUrl,
            'fail_url'=>$failUrl
        );
        $query_string = http_build_query($query_params);
        $login_url = $base_url.'?'.$query_string;
        return $login_url;
    }

    public function makePayment($amount,$email,$userId,$password=null,$authType=null){
        $options = [
            'query' => [
                'appid'=>$this->appId,
                'apppass'=>$this->appPass,
                'cmdid'=>$this->cmdId,
                'serviceid'=>$this->serviceId,
                'ano'=>$this->ano,
                'bno'=>$this->bno,
                'amount'=>$amount*100,
                'cmdparam'=>"$email|$password|$userId|$authType"
            ]
        ];

        $payment_response = $this->client->request('GET',$this->paymentUrl,$options);

        $payment_code = (int)$payment_response->getBody()->getContents();

        $response = new \stdClass();

        $response->code = $payment_code;

        switch($payment_code){
            case 0:
                $response->success = true;
                $response->message = 'Charging is successful';
                break;
            case 3001:
                $response->success = false;
                $response->message = 'Missing Required Field';
                break;
            case 1001:
                $response->success = false;
                $response->message = 'Not Enough Subscriber Balance';
                break;
            case 9022:
                $response->success = false;
                $response->message = 'Authentication Error';
                break;
            case 9999:
                $response->success = false;
                $response->message = 'Other Any kind of error';
                break;
        }
        return $response;
    }
}