<?php

namespace App\Services;

use App\Models\TimeLine;

class TimeLineService
{
    public function createTimeLine(array $data)
    {
        return TimeLine::create($data);
    }

    public function getTimeLines()
    {
        return TimeLine::all();
    }

    public function updateTimeLine(int $id, array $data)
    {
        $timeLine = TimeLine::findOrFail($id);
        $timeLine->update($data);
        return $timeLine;
    }

    public function deleteTimeLine(int $id)
    {
        $timeLine = TimeLine::findOrFail($id);
        $timeLine->delete();
        return $timeLine;
    }
}