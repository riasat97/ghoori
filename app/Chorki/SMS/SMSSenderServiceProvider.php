<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 5/7/15
 * Time: 3:13 AM
 */

namespace Chorki\SMS;

use Illuminate\Support\ServiceProvider;

class SMSSenderServiceProvider extends  ServiceProvider{
    public function register()
    {
//        $this->app->bind(
//            'Chorki\SMS\SMSSender',
//            'Chorki\SMS\DozeSmsSender'
//        );
        $this->app->bind(
            'Chorki\SMS\SMSSender',
            'Chorki\SMS\SmartSms\Config'
        );
    }
}