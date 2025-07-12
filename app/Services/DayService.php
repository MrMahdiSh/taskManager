<?php

namespace App\Services;

use App\Models\Day;
use App\Models\Routine;
use App\Models\RoutineTask;
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

    public function createDay($date)
    {
        $createdDay = Day::create([
            "date" => $date
        ]);

        // fetch routines
        $routines = Routine::all();

        // create routine tasks
        foreach ($routines as $routine) {
            RoutineTask::create([
                "day_id" => $createdDay->id,
                "routine_id" => $routine->id,
                "status" => "planned"
            ]);
        }
    }
}
