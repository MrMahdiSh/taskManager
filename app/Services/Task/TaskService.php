<?php

namespace App\Services\task;

use App\Models\Task;
use App\Services\BaseService;

class TaskService extends BaseService
{
    public function __construct(Task $task)
    {
        parent::__construct($task);
    }
}
