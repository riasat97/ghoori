<?php

namespace Chorki\Subscription;

use Chorki\Repositories\SubscriptionRepositories;
use User;

class EmailSubscriptionRepository extends SubscriptionRepositories implements SubscriptionRepositoryInterface {

    protected $model;

    function __construct(User $model)
    {
        $this->model = $model;
    }

    public function save(User $user)
    {

        $saved = $user->save();
        return $saved;

    }


}