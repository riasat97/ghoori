<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 9/8/15
 * Time: 6:49 PM
 */

namespace Chorki\PaymentSDK;

use Illuminate\Support\Facades\Config;

class BKash {
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    private $base_uri = 'http://www.bkashcluster.com:9080/dreamwave';

    /**
     *  For storing bkash api related username, password and mobile number
     */
    public $user,$pass,$msisdn;

    public function __construct(\GuzzleHttp\Client $client){
        $this->client = $client;
        $this->user = Config::get('bkash.user');
        $this->pass = Config::get('bkash.pass');
        $this->msisdn = Config::get('bkash.msisdn');
    }

    /**
     * @param string $transactionId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTransactionDetails($transactionId){

        $options = [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'json' => [
                'user' => $this->user,
                'pass' => $this->pass,
                'msisdn' => $this->msisdn,
                'trxid' => $transactionId
            ]
        ];

        $response = $this->client->post('http://www.bkashcluster.com:9080/dreamwave/merchant/trxcheck/sendmsg', $options);

        $responseObject = json_decode($response->getBody());

        return $responseObject;
    }
}