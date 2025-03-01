<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\task\TaskService;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the tasks.
     */
    public function index()
    {
        $tasks = $this->taskService->index();
        return response()->json(['tasks' => $tasks], 200);
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in-progress,completed',
        ]);

        $task = $this->taskService->store($validated);
        return response()->json(['message' => 'Task created successfully', 'task' => $task], 201);
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task)
    {
        return response()->json(['task' => $task], 200);
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:pending,in-progress,completed',
        ]);

        $updatedTask = $this->taskService->update((object) array_merge(['id' => $task->id], $validated));
        return response()->json(['message' => 'Task updated successfully', 'task' => $updatedTask], 200);
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        $this->taskService->destroy($task->id);
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
