<?php

use Chorki\Facebook\FacebookAdapter;

class UsersController extends \BaseController {

    private $userRepo,$fbAdapter;

    public function __construct(User $userRepo, FacebookAdapter $fbAdapter ){
        $this->userRepo = $userRepo;
        $this->fbAdapter = $fbAdapter;
    }

	public function userSettings($value='')
	{
        $fbNotConnected = is_null(Auth::user()->fbId);
		return View::make('users.edit')->with('fbNotConnected',$fbNotConnected);
	}

    public function updateUserSettings(){
        $rules = array(
            'name' => 'min:4|max:100|regex:/^[A-Za-z.\s]+$/',
            'new_password' => 'min:8|max:100|confirmed'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        if (!empty(Input::get('new_password'))) {
        	if(!is_null($user->password)){
	            if(!Hash::check(Input::get('old_password'),$user->password)){
	                return Redirect::back()
	                    ->withInput()
	                    ->with('flash_message', 'Old password does not match.')
	                    ->with('flash_type', 'alert-danger');
	            }
	        }

	        $user->password = Hash::make(Input::get('new_password'));
        }
        

        if(!empty(Input::get('name'))){
            $user->name=Input::get('name');
        }

        $user->save();

        return Redirect::back()
            ->with('flash_message', 'All changes updated.')
            ->with('flash_type', 'alert-success');
    }

    /**
     * Attach FB account to the logged in user
     * @return mixed
     */
    function fbConnect(){
        header('Content-Type: application/json');
        $response = new stdClass();
        if(!is_null(Auth::user()->fbId)){
            $response->status = 'failure';
            $response->message = 'User Has Already Attached FB Account';
            return Response::json((array)$response);
        }
        $fbId = Input::get('fbId');
        $userAccessToken = Input::get('accessToken');

        $usersWithSameFbId = $this->userRepo->where('fbId',$fbId)->get();
        if(!$usersWithSameFbId->isEmpty()){
            $response->status = 'failure';
            $response->message = 'This FB Account Is Attached To An Existing User Account';
            return Response::json((array)$response);
        }
        try{
            $this->fbAdapter->setUserAccessToken($userAccessToken,$fbId);
            Auth::user()->fbId = $fbId;
            Auth::user()->save();
            $response->status = 'success';
            $response->message = 'Successfully Attached The FB Account';
            return Response::json((array)$response);
        }catch (Exception $e){
            $response->status = 'failure';
            $response->message = $e->getMessage();
            return Response::json((array)$response);
        }
    }//fbConnect
}