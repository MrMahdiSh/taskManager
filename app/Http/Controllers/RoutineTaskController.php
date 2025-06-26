<?php

namespace App\Http\Controllers;

use App\Services\RoutineTaskService;
use Illuminate\Http\Request;

class RoutineTaskController extends BaseController
{
    protected $routineTaskService;

    public function __construct(RoutineTaskService $routineTaskService)
    {
        $this->routineTaskService = $routineTaskService;
    }

    /**
     * @OA	ag(name="RoutineTasks", description="Operations related to routine tasks")
     */

    /**
     * @OA\Get(
     *     path="/api/v1/routineTasks",
     *     summary="Get all routine tasks",
     *     tags={"RoutineTasks"},
     *     @OA\Response(
     *         response=200,
     *         description="List of routine tasks",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Routine Task Title"),
     *                 @OA\Property(property="description", type="string", example="Routine Task Description")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return $this->response($this->routineTaskService->index());
    }

    /**
     * @OA\Get(
     *     path="/api/v1/routineTasks/{id}",
     *     summary="Get a specific routine task",
     *     tags={"RoutineTasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Routine task details",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Routine Task Title"),
     *             @OA\Property(property="description", type="string", example="Routine Task Description")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        return $this->response($this->routineTaskService->show($id));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/routineTasks/{id}",
     *     summary="Update a routine task",
     *     tags={"RoutineTasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"title", "description"},
     *             @OA\Property(property="title", type="string", example="Updated Routine Task Title"),
     *             @OA\Property(property="description", type="string", example="Updated Routine Task Description")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Routine task updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Updated Routine Task Title"),
     *             @OA\Property(property="description", type="string", example="Updated Routine Task Description")
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        return $this->response($this->routineTaskService->update($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/routineTasks/{id}",
     *     summary="Delete a routine task",
     *     tags={"RoutineTasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Routine task deleted successfully"
     *     )
     * )
     */
    public function destroy($id)
    {
        return $this->response($this->routineTaskService->destroy($id));
    }
}