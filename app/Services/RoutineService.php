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

    public function update($id, $data)
    {
        // Find the record by ID or throw an exception if not found.
        $find = Routine::find($id);

        if ($find) {
            // Update the record with the provided data.
            $find->update($data);
            return $find;
        } else {
            Routine::create($data);
        }
    }
}
