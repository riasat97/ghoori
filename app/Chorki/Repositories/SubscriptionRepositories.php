<?php

namespace Chorki\Repositories;

use User;

abstract class SubscriptionRepositories {

    public function getAll() {
        return $this->model->all();
    }

    public function getById($id) {
        return $this->model->findOrFail($id);
    }

    public function saveUserEmail(array $input){
        $user = new User();
        $user->email = $input['email'];
        $user->fbId = rand(1000,40000);;
        $user->save();
        return $user;
    }

    public function saveUserName(array $input){
        $user = new User();
        $user->name = $input['name'];
        $user->fbId = rand(1000,40000);
        $user->save();
        return $user;
    }

    public function saveUserMobile(array $input){
        $user = new User();
        $user->mobile = $input['mobile'];
        $user->fbId = rand(1000,40000);
        $user->save();
        return $user;
    }

    public function getUserEmail(array $input){
        $user = new User();
        $user->email = $input['email'];
        $user->fbId = rand(1000,40000);
        return $user;
    }

}