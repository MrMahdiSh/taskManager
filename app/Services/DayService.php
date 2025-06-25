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

    public function getAllWithRoutines()
    {
        return $this->model::with('routines')->get();
    }
}