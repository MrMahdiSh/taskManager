<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    /**
     * Display a listing of the tasks.
     */
    public function index()
    {
        return true;
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        return true;
    }

    /**
     * Display the specified task.
     */
    public function show()
    {
        return true;
    }

    /**
     * Update the specified task in storage.
     */
    public function update()
    {
        return true;
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy()
    {
        return true;
    }
}
