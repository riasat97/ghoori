<?php

namespace Chorki\Subscription;

use User;

interface SubscriptionRepositoryInterface {

    public function getAll();
    public function save(User $user);
    public function getById($userId);
    //public function mobileSignUp();
    public function saveUserName(array $input);
    public function saveUserEmail(array $input);
    public function saveUserMobile(array $input);
    public function getUserEmail(array $input);
}