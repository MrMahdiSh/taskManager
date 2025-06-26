<?php

namespace App\Services;

use App\Models\RoutineTask;

class RoutineTaskService
{
    public function index()
    {
        return RoutineTask::all();
    }

    public function store(array $data)
    {
        return RoutineTask::create($data);
    }

    public function show($id)
    {
        return RoutineTask::find($id);
    }

    public function update($id, array $data)
    {
        $routineTask = RoutineTask::find($id);
        if ($routineTask) {
            $routineTask->update($data);
        }
        return $routineTask;
    }

    public function destroy($id)
    {
        $routineTask = RoutineTask::find($id);
        if ($routineTask) {
            $routineTask->delete();
        }
        return $routineTask;
    }
}