<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Models\User;
use App\Repositories\EloquentAbstractRepository;

class UserRepository extends EloquentAbstractRepository {

    public function __construct()
    {
        $this->model = new User();
    }
}
