<?php

namespace App\Http\Controllers;

use App\Services\GoalService;
use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends BaseController
{
    protected $goalService;

    public function __construct(GoalService $goalService)
    {
        $this->goalService = $goalService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/goals",
     *     summary="Get all goals",
     *     tags={"Goals"},
     *     @OA\Response(
     *         response=200,
     *         description="List of goals"
     *     )
     * )
     */
    public function index()
    {
        return $this->response($this->goalService->index());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/goals",
     *     summary="Create a new goal",
     *     tags={"Goals"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","status","priority"},
     *             @OA\Property(property="title", type="string", maxLength=255),
     *             @OA\Property(property="description", type="string", nullable=true),
     *             @OA\Property(property="status", type="string", enum={"planned","active","done"}),
     *             @OA\Property(property="deadline", type="string", format="date", nullable=true),
     *             @OA\Property(property="priority", type="integer", minimum=1, maximum=3)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Goal created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:planned,active,done',
            'deadline' => 'nullable|date',
            'priority' => 'required|integer|min:1|max:3',
        ]);

        return $this->response($this->goalService->store($validatedData));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/goals/{id}",
     *     tags={"Goals"},
     *     summary="Get a specific goal",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(
     *         response=200,
     *         description="A specific goal"
     *     ),
     *     @OA\Response(response=404, description="Not Found"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function show($id)
    {
        return $this->response(Goal::find($id));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/goals/{id}",
     *     summary="Update a goal",
     *     tags={"Goals"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *@OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","status","priority"},
     *             @OA\Property(property="title", type="string", maxLength=255),
     *             @OA\Property(property="description", type="string", nullable=true),
     *             @OA\Property(property="status", type="string", enum={"planned","active","done"}),
     *             @OA\Property(property="deadline", type="string", format="date", nullable=true),
     *             @OA\Property(property="priority", type="integer", minimum=1, maximum=3)
     *         )
     *),
     *     @OA\RequestBody(
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Goal updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Goal not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:planned,active,done',
            'deadline' => 'nullable|date',
            'priority' => 'required|integer|min:1|max:3',
        ]);

        if (!is_array($validatedData)) {
            return $this->response(['error' => 'Invalid data format'], 422);
        }

        return $this->response($this->goalService->update($id, $validatedData));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/goals/{id}",
     *     summary="Delete a goal",
     *     tags={"Goals"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Goal deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Goal not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        return $this->response($this->goalService->destroy($id));
    }
}
