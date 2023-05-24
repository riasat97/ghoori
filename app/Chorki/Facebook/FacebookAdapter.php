<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 4/12/15
 * Time: 12:01 PM
 */

namespace Chorki\Facebook;

use Facebook\Entities\AccessToken;
use Facebook\FacebookSDKException;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Session, Config, Exception;

class FacebookAdapter {
    /**
     * Prefix to use for session variables
     * @var string
     */
    private $sessionPrefix = 'FBADPTR_';

    /**
     * Flag to see whether to use or not page access token instead of user access token
     * @var bool
     */
    private $usePageAccessToken = false;

    private $pageAccessToken = null;

    private $permissions, $appId, $appSecret;

    public function __construct(){
        $this->appId = Config::get('facebook.appId');
        $this->appSecret = Config::get('facebook.secret');
        $this->permissions= Config::get('facebook.permissions');
        FacebookSession::setDefaultApplication($this->appId,$this->appSecret);
    }


    /**
     * Store the user access token
     * @param string $userAccessToken
     */
    private function storeUserAccessToken($userAccessToken){
        Session::put($this->sessionPrefix.'userAccessToken',$userAccessToken);
    }


    /**
     * Returns the the user access token
     * @return null|string
     * @throws Exception
     */
    private function loadUserAccessToken(){
        $token = Session::get($this->sessionPrefix.'userAccessToken');
        if(!$token){
            throw new Exception('User access token was not stored');
        }
        return $token;
    }

    /**
     * @param $userAccessToken
     * @param $fbId
     * @return bool
     * @throws Exception
     * @throws \Facebook\FacebookRequestException
     */
    public function verifyUserAccessToken($userAccessToken, $fbId){
        $param = ['input_token'=>$userAccessToken];
        $request = new FacebookRequest( FacebookSession::newAppSession($this->appId, $this->appSecret), 'GET', '/debug_token',$param);
        $response = $request->execute()->getResponse();
        if(isset($response->data->error)){
            throw new Exception($response->data->error->message);
        }
        if($response->data->user_id!==$fbId){
            throw new Exception('The given access token does not belong to the given node');
        }
        if(!$response->data->is_valid){
            throw new Exception('The given access token is invalid');
        }
    }

    /**
     * @param string $userAccessToken
     * @param $fbId
     * @throws Exception
     * @throws \Facebook\FacebookRequestException
     */
    public function setUserAccessToken($userAccessToken, $fbId = null){
        if($fbId){
            $this->verifyUserAccessToken($userAccessToken,$fbId);
        }
        $shortToken = new AccessToken($userAccessToken);
        $longToken = $shortToken->extend();
        $this->storeUserAccessToken($longToken);
    }


    /**
     * @param string $pageAccessToken
     */
    public function setPageAccessToken($pageAccessToken){
        //@todo validation
        $this->pageAccessToken = $pageAccessToken;
    }

    /**
     * @return null|string
     */
    private function getPageAccessToken(){
        return $this->pageAccessToken;
    }

    /**
     * @param null|string $pageAccessToken
     */
    public function setPageMode($pageAccessToken=null){
        if($pageAccessToken!==null){
            $this->setPageAccessToken($pageAccessToken);
        }
        $this->usePageAccessToken = true;
    }

    /**
     *
     */
    public function resetMode(){
        $this->usePageAccessToken = false;
    }


    /**
     * @return null|string
     * @throws Exception
     */
    private function loadAccessToken(){
        if($this->usePageAccessToken===true){
            return $this->getPageAccessToken();
        }
        return $this->loadUserAccessToken();
    }

    /**
     * @param string $redirectUrl
     * @param null|array $permissions
     * @return string
     */
    public function getLoginUrl($redirectUrl, $permissions = null){
        if(!$permissions){
            $permissions = $this->permissions;
        }
        $helper= new LaravelFacebookRedirectLoginHelper($redirectUrl);
        $fbLoginUrl=$helper->getLoginUrl($permissions);
        return $fbLoginUrl;
    }


    /**
     * Log the user and get the Long-Term access token
     */
    public function fbLogin(){
        $helper = new LaravelFacebookRedirectLoginHelper();
        $session = $helper->getSessionFromRedirect();
        if(!$session){
            throw new Exception('Failed to get session from redirect.');
        }
        $shortToken = $session->getAccessToken();
        $longToken = $shortToken->extend();
        $this->storeUserAccessToken($longToken);
    }


    /**
     * @param string $url
     * @param null|string $method
     * @param null|array $parameters
     * @return array
     * @throws Exception
     */
    public function apiCall($url, $method = 'GET', $parameters = null){

        $fbToken = $this->loadAccessToken();
        $session = new FacebookSession($fbToken);
        try{
            $session->validate($this->appId,$this->appSecret);
        }catch ( FacebookSDKException $e){
            throw new Exception($e->getMessage());
        }
        $request = new FacebookRequest($session,$method,$url,$parameters);
        $response = $request->execute();
        return $response->getResponse();
    }

    /**
     * @param array $parameterArray
     * @return array
     * @throws Exception
     */
    public function batchApiCall($parameterArray){
        // @TODO make this work
        $url= '?batch='.urlencode(json_encode($parameterArray));
        //dd($url);
        $method = 'POST';
        return $this->apiCall($url,$method);
    }
}