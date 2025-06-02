<?php

namespace App\Domain\Task\Repositories;

use App\Domain\Task\Models\Task;
use App\Repositories\EloquentAbstractRepository;

class TaskRespository extends EloquentAbstractRepository
{
    public function __construct()
    {
        $this->model = new Task();
    }
}
