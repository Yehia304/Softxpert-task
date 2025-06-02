<?php

namespace App\Domain\Task\Enums;

use App\Constants\Status;

enum TaskStatus: string
{
    case PENDING = Status::PENDING;
    case COMPLETED = Status::COMPLETED;
    case CANCELLED = Status::CANCELLED;

    public static function getTaskStatuses(): array
    {
        return array(self::PENDING->value, self::COMPLETED->value, self::CANCELLED->value);
    }
}
