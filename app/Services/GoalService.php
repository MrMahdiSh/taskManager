<?php

namespace App\Services;

use App\Models\Goal;
use App\Services\BaseService;

class GoalService extends BaseService
{
    public function __construct(Goal $goal)
    {
        parent::__construct($goal);
    }
}