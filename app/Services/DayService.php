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

    public function findByDate($date)
    {
        $day = $this->model::where('date', $date)->first();

        if (!$day) {
            // we have to create this day!
            Day::create([
                "date" => now()->toDateString()
            ]);
            // set the routines
            
        }
        return $day;
    }
}
