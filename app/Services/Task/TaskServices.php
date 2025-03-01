<?php

namespace App\Services\task;

use App\Models\Task;

class TaskServices
{
    /**
     * Create a new task.
     */
    public function createTask($data)
    {
        return Task::create($data);
    }

    /**
     * Update an existing task.
     */
    public function updateTask($id, $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    /**
     * Delete a task.
     */
    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return true;
    }

    /**
     * Get a task by ID.
     */
    public function getTaskById($id)
    {
        return Task::findOrFail($id);
    }

    /**
     * Get all tasks.
     */
    public function getAllTasks()
    {
        return Task::all();
    }
}
