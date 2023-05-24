<?php

class EcourierRegistration extends \Eloquent {
	protected $table = 'ecourierregistrations';
    protected $guarded = [];
    public function getRequiredApiInfo($shop){
     return $apiInfo= ['user_id'=>$shop->ecourierRegistration->user_id,
            'api_key'=>$shop->ecourierRegistration->api_key,
            'api_secret'=> $shop->ecourierRegistration->api_secret,
            'user_name'=>$shop->ecourierRegistration->user_name];
    }
}