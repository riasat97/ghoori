<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 11/1/15
 * Time: 10:52 AM
 */

namespace Chorki\PaymentSDK;


use Illuminate\Support\Facades\Config;
use Exception;

class EasyPayWay {
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    protected $requiredParameters = [
        'store_id','tran_id','success_url','fail_url',
        'cancel_url', 'amount', 'currency', 'signature_key',
        'desc','cus_name','cus_email','cus_add1','cus_city',
        'cus_state','cus_postcode','cus_country','cus_phone'
    ];
    protected $optionalParameters = [
        'ipn_url','opt_a','opt_b','opt_c','opt_d','payment_type',
        'amount_vat','amount_vatRatio','amount_tax', 'amount_taxRatio',
        'amount_processingfee','amount_processingfee_ratio','cus_add2',
        'ship_name','ship_add1','ship_add2','ship_city','ship_state',
        'ship_postcode','ship_country'
    ];

    protected $requestUri, $lookUpUri;

    protected $storeId, $signatureKey;

    public function __construct(\GuzzleHttp\Client $client){
        $this->client = $client;
        $this->storeId = Config::get('easypayway.store_id');
        $this->signatureKey = Config::get('easypayway.signature_key');
        $this->requestUri = Config::get('easypayway.request_uri');
        $this->lookUpUri = Config::get('easypayway.lookup_uri');
    }

    /**
     * @param array $parameters
     * @return bool
     */
    protected function requiredParametersExists($parameters){
        $getOnlyRequiredParameters = array_only($parameters,$this->requiredParameters);
        if(count(array_diff($this->requiredParameters,array_keys($getOnlyRequiredParameters)))==0){
            return true;
        }
        return false;
    }

    /**
     * @param array $parameters
     * @return array
     */
    protected function getAllowedParameters($parameters){
        $allowedParameters = array_merge($this->optionalParameters,$this->requiredParameters);
        return array_only($parameters,$allowedParameters);
    }

    protected function composeExceptionMessageFromErrorObject(\stdClass $errorObject){
        $message = "Parameter Errors: ";
        $errors = (array)$errorObject;
        $firstIteration = true;
        foreach($errors as $error => $description){
            if(!$firstIteration){
                $message.=' | ';
            }else{
                $firstIteration = false;
            }
            $message.=$error.' : '.$description;
        }
        return $message;
    }

    /**
     * @param array|null $parameters
     * @return mixed
     * @throws Exception
     */
    public function getPaymentUrl($parameters = null){
        $parameters['store_id'] = $this->storeId;
        $parameters['signature_key'] = $this->signatureKey;
        if($this->requiredParametersExists($parameters)){

            $postData = $this->getAllowedParameters($parameters);

            $options = [
                'form_params' => $postData
            ];
            $response = $this->client->request('POST',$this->requestUri,$options);

            $responseBody = json_decode($response->getBody());

            if(is_object($responseBody)){
                $message = $this->composeExceptionMessageFromErrorObject($responseBody);
                throw new Exception($message);
            }

            if(strpos($responseBody,'http')!==0){
                throw new Exception($responseBody);
            }

            return $responseBody;

        }else{
            throw new Exception('One or more required parameter is missing.');
        }
    }

    public function lookupTransactionDetails($transactionId){
        $options = [
            'query' => [
                'store_id'=> $this->storeId,
                'signature_key'=> $this->signatureKey,
                'request_id' => $transactionId,
                'type' => 'json'
            ]
        ];

        $response = $this->client->request('GET',$this->lookUpUri,$options);

        $responseObject = json_decode($response->getBody());

        $responseArray = (array) $responseObject;

        return $responseArray;
    }
}