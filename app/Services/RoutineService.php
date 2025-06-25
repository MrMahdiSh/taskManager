<?php

namespace App\Services;

use App\Models\Routine;
use App\Services\BaseService;

class RoutineService extends BaseService
{
    public function __construct(Routine $routine)
    {
        parent::__construct($routine);
    }
}