<?php

use Chorki\shops\Models\Shop;
use Chorki\Subscription\SubscriptionRepositoryInterface;
use Illuminate\Support\Facades\Auth;


class SubscriptionController extends \BaseController {

    public $subscriber;

    function __construct(SubscriptionRepositoryInterface $subscriber, Shop $shops){

        $this->subscriber = $subscriber;
        $this->shops = $shops;
    }
    public function emailSubscription(){

        return View::make('public.shop._partials.info');

    }

    public function emailSubscriptionPost(){

        $temp = Input::get('email');
        $fbUserName = Auth::user();

        if( !$fbUserName ) {
            //$subscriber = $this->subscriber->saveUserEmail(Input::all());
            return Response::json(['success'=>true,'subscriber'=> Input::all()]);
        }
        else
            return "Error";

       /* if($temp === $user->email){

            return 'Failed! The Email is already registered.';
        }
        if ($temp == ''){
            return 'Failed! You must enter your email';
        }
        if ($fbUserName){
            return 'You are already logged in and your name is  '. $fbUserName->name;
        }
        else{
            $subscriber = $this->subscriber->saveUserEmail(Input::all());
            return View::make('subscriptions.subscriptionPopup')->with('subscriber', $subscriber);
            //return 'Your have been logged in by this Email: '. $subscriber->email;
        }*/

    }

    public function subscribePost(){

        $email = $this->subscriber->saveUserEmail(Input::all());
        $name = $this->subscriber->saveUserName(Input::all());
        $mobile = $this->subscriber->saveUserMobile(Input::all());

        $data = array(
            'name' => $name->name,
            'email' => $email->email,
            'mobile' => $mobile->mobile
        );

        Mail::send('subscriptions.emailSend', $data, function($message)use($email, $name){
            $message->to($email->email, $name->name)
                ->subject('Subscription Confirmation');
        });

        if( $name && $mobile ) {

            return Response::json(['success'=>true,'subscriber'=> Input::all()]);
        }

        else
            return "Error";

    }

    public function gettingStarted(){

        $email = $this->subscriber->saveUserEmail(Input::all());
        $name = $this->subscriber->saveUserName(Input::all());
        $mobile = $this->subscriber->saveUserMobile(Input::all());

        $shop = new Shop;
        $shop->title = Input::get('title');
        $shop->save();

        $data = array(
            'name' => $name->name,
            'email' => $email->email,
            'mobile' => $mobile->mobile,
        );

        Mail::send('subscriptions.emailSend', $data, function($message)use($email, $name){

            $message->to($email->email, $name->name)->subject('Subscription Confirmation');

        });

        if( $name && $mobile ) {

            return Response::json(['success'=>true, 'subscriber'=> Input::all()]);
        }

        else
            return "Error";

    }

}