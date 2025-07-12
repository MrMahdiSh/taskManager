<?php

namespace App\Services;

use App\Models\Day;
use App\Models\Routine;
use App\Models\RoutineTask;
use App\Models\Session;
use App\Services\BaseService;

class SessionService extends BaseService
{
    public function __construct(Session $session)
    {
        parent::__construct($session);
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
