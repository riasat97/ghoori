<?php
/**
 * Created by PhpStorm.
 * User: arafat
 * Date: 8/17/15
 * Time: 4:15 PM
 * For tuts:    http://www.karlvalentin.de/1903/write-your-own-auth-driver-for-laravel-4.html
 *              https://laracasts.com/forum/?p=910-how-to-extend-auth/p1#p4276
 */

namespace Chorki\Auth;


use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Auth\UserInterface;
use Illuminate\Hashing\HasherInterface;
use Chorki\Facebook\FacebookAdapter;

class ChorkiUserProvider extends EloquentUserProvider{


    public function __construct(HasherInterface $hasher, $model)
    {
        parent::__construct($hasher,$model);
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $query = $this->createModel()->newQuery();

        foreach ($credentials as $key => $value)
        {
            if ( !((str_contains($key, 'password'))||(str_contains($key, 'accessToken')))) $query->where($key, $value);
        }

        return $query->first();
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Auth\UserInterface  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(UserInterface $user, array $credentials){
        // This one is not Auth::validate()
        // For details see hasValidCredentials and attempt method of Auth (Guard) class
        if(isset($credentials['fbId'])&&isset($credentials['accessToken'])){
            $fb = new FacebookAdapter();
            try{
                $fb->verifyUserAccessToken($credentials['accessToken'],$credentials['fbId']);
            }catch (\Exception $e){
                return false;
            }
            return true;
        }

        $plain = $credentials['password'];

        return $this->hasher->check($plain, $user->getAuthPassword());
    }
}