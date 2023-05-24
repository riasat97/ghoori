<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 7/7/15
 * Time: 2:35 PM
 */

namespace Chorki\ShippingSDK;

use Chorki\Orders\Models\Order;
use Chorki\Orders\Models\OrderRepository;
use Chorki\shops\Models\Shop;
use Chorki\shops\Models\ShopRepositoryInterface;
use Config;
use Exception;
use stdClass;
use Log;

class ECourier{

    protected $url;

    protected $user_id, $user_name, $api_key, $api_secret;


    public function __construct($user_id=null, $user_name=null, $api_key=null, $api_secret=null){

        $this->user_id= $user_id;
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
        $this->user_name = $user_name;
        $this->url = Config::get('ecourier.url');

    }

    /**
     * @param string $user_id
     * @param string $user_name
     * @param string $api_key
     * @param string $api_secret
     */
    public function setAPI($user_id, $user_name, $api_key, $api_secret){
        $this->user_id= $user_id;
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
        $this->user_name = $user_name;
    }

    /**
     * Throws exeception if any one of the parameter is not set
     * @throws Exception
     */
    private function checkAPI(){
        if($this->user_id===null||$this->api_key===null||$this->api_secret===null){
            throw new Exception("user_id, api_key, api_secret was not set");
        }
    }

    /**
     * @param string $path
     * @param array|null $parameters
     * @return string
     */
    private function apiCall($path, $parameters = null, $shop_id = null){
        $query_string = '?';
        foreach($parameters as $key => $value){
            $query_string .= $key . '=' . urlencode($value) . '&';
        }
        $requestUrl = $this->url . $path . $query_string;
      //  dd($requestUrl);
        Log::info('Ecourier request', ['requestUrl' => $requestUrl]);
        $responseString = file_get_contents($requestUrl);
        $response = json_decode($responseString);
        if(is_null($response)){
            $response = new stdClass();
            $response->error = $responseString;

            $status = new stdClass();
            $status->Status= false;
            $response->Parcel= $status;

        }

        return $response;
    }

    /**
     * @param array $parameters
     * @param array $allowedKeys
     * @return array
     */
    private function getAllowedParameters($parameters, $allowedKeys){
        foreach ($allowedKeys as $key)
        {
            array_set($allowedParameters, $key, array_get($parameters, $key));
        }
        $cleanParameters = array_filter($allowedParameters);
        return $cleanParameters;
    }

    private function getCodeFromWeight($weightInGram){
        if($weightInGram<= 500){
            return 1;
        }
        if($weightInGram <= 1000){
            return 2;
        }
        if($weightInGram <= 2000){
            return 4;
        }
        return 4;
    }

    /**
     * @param Shop $shop
     * @param null $optionalParameters
     * @return object
     * @internal param int $shopId
     * @internal param null $optionalParams
     * @internal param array $parameters
     */
    public function registerShop(Shop $shop , $optionalParameters = null){
        $password = uniqid();
        $parameters = array(
            'user_id' => Config::get('ecourier.user_id'),
            'api_key' => Config::get('ecourier.api_key'),
            'api_secret' => Config::get('ecourier.api_secret'),
            'site_url' => 'https://'.$shop->subDomain.'.ghoori.com.bd',
            'email' => $shop->email,
            'mobile' => $shop->mobile,
            'company' => $shop->subDomain,
            'password' => $password
        );
        $allowedOptionalParameters =['post_code','address','bank_name','account'];
        $cleanOptionalParameters = $this->getAllowedParameters($optionalParameters,$allowedOptionalParameters);
        $parameters = array_merge($parameters,$cleanOptionalParameters);
        $path = 'api/registerESO.php';
        $response = $this->apiCall($path,$parameters);
        if($response->status){
            $response = $response->data;
            $response->success= true;
            $response->user_id = $response->id;
            $response->password = $password;
            unset($response->status);
            unset($response->id);
        }else{
            $response->success = false;
            $response->message = $response->msg;
            unset($response->status);
            unset($response->msg);
        }
        return $response;
    }

    /**
     * @param Order $order
     * @return object
     * @throws Exception
     */
    public function insertParcel(Order $order){
        $this->checkAPI();
        $order->load('shippingAddress','shippingPackage','shippingLocation','shop');
        $orderRepo = app('Chorki\Orders\Models\OrderRepositoryInterface');
        $parameters = array(
            'parcel'=>'order',
            'user_id' => $this->user_name,
            'api_key' => $this->api_key,
            'api_secret' => $this->api_secret,
            'pid'   => $order->id,
            'recipient_name' => $order->shippingAddress->name,
            'recipient_mobile' => $order->shippingAddress->mobile,
            'recipient_address' => $order->shippingAddress->address,
            'recipient_zip' => $order->shippingAddress->postcode,
            'delivery_timing' => $order->shippingPackage->code,
            'shipping_area' => ($order->shippingLocation->id > 1 ? 2 : 1),
            'parcel_weight' => $this->getCodeFromWeight($order->totalOrderWeight),
            // 'product_price' => ceil($order->total - $order->shippingCharge),
            'product_price' => ceil($order->total),
            'pick_address' => !empty($order->shop->pickUpAddress)?$order->shop->pickUpAddress:$order->shop->address
        );
        $path = 'api/';
        $response = $this->apiCall($path,$parameters, $order->shop_id);
        if(isset($response->Parcel) && $response->Parcel->Status){
            $response->status = $response->Parcel->Status;
            $response->parcel_id = $response->Parcel->ID;
            unset($response->Parcel);
        }
        else{
            $response->status = false;
            unset($response->Parcel);
        }
        return $response;
    }

    /**
     * @param $parcelId
     * @return object
     * testing parcel query api_key : Tfbk
     */
    public function parcelInquiry($parcelId){
        $this->checkAPI();
        $parameters=array(
            'api_key'=>$this->api_key,
            'cid'=>$parcelId
        );
        // Log::info('Ecourier parcel status request', ['parcelId' => $parcelId]);
        $path = 'api/productDetails.php';
        $response = $this->apiCall($path,$parameters);
        return $response;
    }
    public function parcelCancel($parcelId){
        $this->checkAPI();
        $parameters=array(
            'user_id' => $this->user_name,
            'api_key' => $this->api_key,
            'api_secret' => $this->api_secret,
            'consignment_no'=>$parcelId,
            'status'=> 'S12',
            'comment'=>'cancel parcel'
        );
        $path = 'api/parcelStatusUpdate.php';
        $response = $this->apiCall($path,$parameters);
        Log::info('Ecourier cancel response', ['response' => $response]);
        return $response;
    }
}