<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 4/11/15
 * Time: 1:15 AM
 */
namespace Chorki\Facebook;

use Input, Session, Request, Facebook\FacebookRedirectLoginHelper;

class LaravelFacebookRedirectLoginHelper extends FacebookRedirectLoginHelper
{
    /**
     * Prefix to use for session variables
     * @var string
     */
    private $sessionPrefix = "LFRLH_";

    public function __construct($redirect_uri = null ) {
        if (empty($redirect_uri)) $redirect_uri = Request::url();
        parent::__construct($redirect_uri);
    }

    protected function storeState($state)
    {
        Session::put($this->sessionPrefix.'state', $state);
    }

    protected function loadState()
    {
        $this->state = Session::get($this->sessionPrefix.'state');
        return $this->state;
    }
}