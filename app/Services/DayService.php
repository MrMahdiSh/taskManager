<?php

namespace App\Services;

use App\Models\Day;
use App\Services\BaseService;

class DayService extends BaseService
{
    public function __construct(Day $day)
    {
        parent::__construct($day);
    }

    public function findByDate($date)
    {
        return $this->model::where('date', $date)
            ->with("routineTasks", "tasks", "sessions")
            ->first();
    }
}
