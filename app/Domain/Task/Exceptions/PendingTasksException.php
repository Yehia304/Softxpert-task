<?php

namespace App\Domain\Task\Exceptions;

use Exception;

class PendingTasksException extends Exception
{
    public function __construct()
    {
        parent::__construct('You are not allowed to update this task because it still has some pending tasks.');
    }
}
