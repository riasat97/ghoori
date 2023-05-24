<?php

use Chorki\Facebook\FacebookAdapter;
use Illuminate\Support\Facades\Auth;
Use Log as Log;

class SignUpController extends BaseController {
    private $user,$fbAdptr;
    public function __construct(User $user, FacebookAdapter $fbAdptr){
        $this->user = $user;
        $this->fbAdptr = $fbAdptr;
    }

    public function showFbLogin(){
        if(Auth::check()){
            //@todo understand and clean up
            $user=User::find(Auth::user()->id);
            if( $shop=$user->shop){
            $shopId = $user->shop->id;
            Session::put('shop_id',$shopId);
            Session::put('shop',$shop);
            Session::put('user',Auth::user());
            }
            if(!empty(Input::get('redirectUrl'))){
                $redirectUrl = Input::get('redirectUrl');
                $redirectHost = parse_url($redirectUrl)['host'];
                if (Config::get('session.domain') != null) {
                    if ( strpos( $redirectHost, Config::get('session.domain') ) ) {
                        
                        return Redirect::to($redirectUrl);
                    }
                    else return Redirect::route('home');
                }
                elseif (Config::get('session.domain') == null && strpos( $redirectHost, 'localhost' ) ) {
                    return Redirect::to($redirectUrl);
                }
                else return Redirect::route('home');
                    
                
            }
            else return Redirect::route('home');
        }
        return View::make('signUp.fbLogIn');
    }

    public function processFbLogin(){
        // @todo not in use
        $code = Input::get('code');
        if(!$code){
            return Redirect::route('home');
        }
        try{
            $this->fbAdptr->fbLogin();
        }catch (Exception $e){
            //@todo handle this
            return Redirect::route('home');
        }
        try{
            $fbUserData= $this->fbAdptr->apiCall('/me','GET');
        }catch (Exception $e){
            //@todo handle this too
            return Redirect::route('home');
        }

        $fbUserData = (array)$fbUserData;
        $fbUserId = $fbUserData['id'];

        if(Auth::attempt(['fbId'=>$fbUserId,'password'=>''])){
            $user=User::find(Auth::user()->id);

            if( $shop=$user->shop){
                $shopId = $user->shop->id;
                Session::put('shop_id',$shopId);
                Session::put('shop',$shop);
                Session::put('user',Auth::user());
            }
            return Redirect::route('home');
        }else{
            $fbUserData['fbId']=$fbUserData['id'];
            unset($fbUserData['id']);
            $this->user->create($fbUserData);
            Auth::attempt(['fbId'=>$fbUserId,'password'=>'']);
            $user=User::find(Auth::user()->id);
            if( $shop=$user->shop){
                $shopId = $user->shop->id;
                Session::put('shop_id',$shopId);
                Session::put('shop',$shop);
                Session::put('user',Auth::user());
            }
            return Redirect::route('home');
        }
    }//processFbLogin

    private function setSessionShop(){
        $user=User::find(Auth::user()->id);
        if( $shop=$user->shop){
            $shopId = $user->shop->id;
            Session::put('shop_id',$shopId);
            Session::put('shop',$shop);
            Session::put('user',Auth::user());
        }
    }

    protected function getFbReLoginResponseObject($fbId,$userAccessToken){
        $response = new stdClass();
        Log::info('facebook re-login attempt', array('fbId' => $fbId));

        if(is_null(Auth::user()->fbId)){
            $response->status = 'failure';
            $response->message = 'You have not yet attached any facebook account. Please go to user settings for attaching.';
        }elseif(Auth::user()->fbId == $fbId){
            try{
                $this->fbAdptr->setUserAccessToken($userAccessToken,$fbId);
                $response->status = 'success';
                Log::info('facebook re-login success', array('fbId' => $fbId));
            }catch (Exception $e){
                $response->status = 'failure';
                $response->message = $e->getMessage();
            }
        }else{ //another facebook account
            $response->status = 'failure';
            $response->message = 'Given facebook account is different from the attached facebook account!!';
        }
        return $response;
    }//getFbReLoginResponseObject

    protected function getFbLoginResponseObject($fbId,$userAccessToken){
        $credentials = array(
            'fbId'=>$fbId,
            'accessToken'=>$userAccessToken
        );
        $response = new stdClass();

        Log::info('facebook login attempt', array('fbId' => $fbId));

        if(Auth::validate($credentials)){ // User signed up before
            try{
                Auth::attempt($credentials);
                $this->setSessionShop(); //@todo too bad
                $response->status = 'success';
                $this->fbAdptr->setUserAccessToken($userAccessToken,$fbId);
                Log::info('facebook login success', array('fbId' => $fbId));
            }catch(Exception $e){
                $response->status = 'failure';
                $response->message = $e->getMessage();
                Log::info('facebook login failed', array('fbId' => $fbId));
            }
        }else{ // New User
            try{
                $this->fbAdptr->setUserAccessToken($userAccessToken,$fbId);
                $fbUserData= (array)$this->fbAdptr->apiCall('/me?fields=id,gender,name,email');
                $fbUserData['fbId']=$fbUserData['id'];
                unset($fbUserData['id']);
                $user = $this->user->firstOrNew(array('email' => $fbUserData['email']));
                $user->fill($fbUserData)->save();
                Auth::attempt($credentials);
                Log::info('facebook login new user', array('fbId' => $fbUserData['fbId']));
                $this->setSessionShop(); //@todo too bad
                $response->status = 'success';
            }catch(Exception $e){
                $response->status = 'failure';
                $response->message = $e->getMessage();
                Log::info('facebook login failed', array('fbId' => $fbId));
            }
        }
        return $response;
    }//getFbLoginResponseObject

    public function ajaxFbLogin(){
        header('Content-Type: application/json');
        $fbId = Input::get('fbId');
        $userAccessToken = Input::get('accessToken');
        if(Auth::check()){// Already logged in user
            $response = $this->getFbReLoginResponseObject($fbId,$userAccessToken);
        }else{
            $response = $this->getFbLoginResponseObject($fbId,$userAccessToken);
        }
        return Response::json((array)$response);
    }

    public function emailSignUp(){
        $rules = array(
            'name' => 'required|min:4|max:100|regex:/^[A-Za-z\s.]+$/',
            'email' => 'required|between:6,100|email',
            'password' => 'required|min:8|max:100|confirmed'
        );
        $validator = Validator::make(Input::all(), $rules);
        $redirectUrl = Input::get('redirectUrl',URL::route('home'));
        if ($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }
        try {
            $user = $this->user->firstOrNew(array('email' => Input::get('email')));
            if(!is_null($user->password)){
                return Redirect::route('login.show')
                    ->with('auth_flash_message', 'Given email address is already registered.')
                    ->with('flash_type', 'alert-danger');
            }
            $user->name = Input::get('name');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            return Redirect::route('login.show', ['redirectUrl'=>$redirectUrl])->withInput()
                ->with('auth_flash_message', 'Welcome '.Input::get('name').'. Please login with your credentials.')
                ->with('flash_type', 'alert-success');
        } catch (Exception $e) {
            Log::error('Signup error', [$e->getMessage()]);
            return Redirect::back()->withInput()
                ->with('auth_flash_message', 'Sorry we could not sign you in right now. Could you please check back later? Thank You.')
                ->with('flash_type', 'alert-danger');
        }
        
    }

    public function emailLogin(){
        $credentials = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );
        if(Auth::attempt($credentials)){
            $this->setSessionShop();
            $redirectUrl = Input::get('redirectUrl',URL::route('home'));
            Log::info('Email login successful', array('email' => $credentials['email']));
            return Redirect::to($redirectUrl);
        }else{
            Log::info('Email login failed', array('email' => $credentials['email']));
            return Redirect::back()
                ->withInput()
                ->with('auth_flash_message', 'Sorry we could not log you in. Are you sure that you have given the correct credentials?')
                ->with('flash_type', 'alert-danger');
        }
    }

    public function userLoginStatus(){
        header('Content-Type: application/json');
        
        $response = new stdClass();
        if(Auth::check()){
            $response->status= 'logged_in';
        }else{
            $response->status= 'not_logged_in';
        }
        return Response::json((array)$response)->setCallback(Input::get('callback'));
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return Redirect::route('home')
            ->with('flash_message', 'Successfully Logged Out.')
            ->with('flash_type', 'alert-success');
    }

    public function edit(){  // @todo not in use
        $userData=Auth::user()->toArray();
        return View::make('signUp.editUser')->with('userData',$userData);
    }

    public function update(){ // @todo not in use
        $user=$this->user->find(Auth::user()->id);
        $user->fill(Input::only('name','gender','mobile'))->save();
        return Redirect::route('users.show');
    }
}