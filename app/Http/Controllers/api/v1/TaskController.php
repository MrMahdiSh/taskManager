<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Day;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\task\TaskService;
use Mockery\Undefined;

class TaskController extends BaseController
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/tasks",
     *     summary="Get all tasks",
     *     tags={"Tasks"},
     *     @OA\Response(
     *         response=200,
     *         description="List of tasks",
     *         @OA\JsonContent(
     *             @OA\Property(property="tasks", type="array", @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Task Title"),
     *                 @OA\Property(property="description", type="string", example="Task Description"),
     *                 @OA\Property(property="status", type="string", example="pending")
     *             ))
     *         )
     *     )
     * )
     */
    public function index()
    {
        $tasks = $this->taskService->index();
        return response()->json(['tasks' => $tasks], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/tasks",
     *     summary="Create a new task",
     *     tags={"Tasks"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="New Task"),
     *             @OA\Property(property="description", type="string", example="Task details"),
     *             @OA\Property(property="date", type="date"),
     *             @OA\Property(property="priority", type="integer"),
     *             @OA\Property(property="status", type="string", enum={"pending", "in-progress", "completed"}, example="pending")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Task created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Task created successfully"),
     *             @OA\Property(property="task", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="New Task"),
     *                 @OA\Property(property="description", type="string", example="Task details"),
     *                 @OA\Property(property="status", type="string", example="pending")
     *             )
     *         )
     *     )
     * )
     */
    public function store(CreateTaskRequest $request)
    {
        // $task = $this->taskService->store($request->validated());

        // find the day
        $day = Day::where("date", $request->input("date"))->first();

        if (!$day) {
            return response()->json(['message' => 'Day not found!'], 404);
        }

        $data = $request->validated();

        $data["day_id"] = $day->id;

        $data["date"] = null;

        $task = $this->taskService->store($data);

        return response()->json(['message' => 'Task created successfully', 'task' => $task], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/tasks/{id}",
     *     tags={"Tasks"},
     *     summary="Get a specific task",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(
     *         response=200,
     *         description="A specific task"
     *     ),
     *     @OA\Response(response=404, description="Not Found"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function show($id)
    {
        return $this->response(Task::find($id));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/tasks/{id}",
     *     summary="Update an existing task",
     *     tags={"Tasks"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Updated Task"),
     *             @OA\Property(property="description", type="string", example="Updated details"),
     *             @OA\Property(property="status", type="string", enum={"pending", "in-progress", "completed"}, example="completed")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Task updated successfully"),
     *             @OA\Property(property="task", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Updated Task"),
     *                 @OA\Property(property="description", type="string", example="Updated details"),
     *                 @OA\Property(property="status", type="string", example="completed")
     *             )
     *         )
     *     )
     * )
     */
    public function update($id, UpdateTaskRequest $request)
    {
        $updatedTask = $this->taskService->update($id, $request->validated());
        return response()->json(['message' => 'Task updated successfully', 'task' => $updatedTask], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/tasks/{id}",
     *     summary="Delete a task",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Task deleted successfully")
     *         )
     *     )
     * )
     */
    public function destroy(Task $task)
    {
        $this->taskService->destroy($task->id);
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/theTasks/important",
     *     summary="Get important tasks",
     *     tags={"Tasks"},
     *     @OA\Response(
     *         response=200,
     *         description="List of important tasks",
     *         @OA\JsonContent(
     *             @OA\Property(property="tasks", type="array", @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Important Task Title"),
     *                 @OA\Property(property="description", type="string", example="Important Task Description"),
     *                 @OA\Property(property="priority", type="integer", example=1)
     *             ))
     *         )
     *     )
     * )
     */
    public function getImportantTasks()
    {
        $tasks = Task::where('priority', 3)->get();
        return response()->json(["tasks" => $tasks], 200);
    }
}
