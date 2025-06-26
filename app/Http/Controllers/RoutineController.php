<?php

namespace App\Http\Controllers;

use App\Services\RoutineService;
use App\Models\Routine;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="routines",
 *     description="API Endpoints of Routine"
 * )
 */
class RoutineController extends BaseController
{
    protected $routineService;

    public function __construct(RoutineService $routineService)
    {
        $this->routineService = $routineService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/routines",
     *     tags={"routines"},
     *     summary="Get list of routines",
     *     description="Returns list of routines",
     *     @OA\Response(
     *         response=200,
     *         description="A list of routines"
     *     ),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=403, description="Forbidden")
     * )
     */
    public function index()
    {
        return $this->response($this->routineService->index());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/routines",
     *     tags={"routines"},
     *     summary="Create a new routine",
     *     description="Stores a new routine",
     *@OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title"},
     *             @OA\Property(property="title", type="string", maxLength=255),
     *             @OA\Property(property="description", type="string", maxLength=255),
     *         )
     *),
     *     @OA\Response(
     *         response=201,
     *         description="Routine created successfully"
     *     ),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=403, description="Forbidden")
     * )
     */
    public function store(Request $request)
    {
        return $this->response($this->routineService->store($request->all()));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/routines/{id}",
     *     tags={"routines"},
     *     summary="Get a specific routine",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(
     *         response=200,
     *         description="A specific routine"
     *     ),
     *     @OA\Response(response=404, description="Not Found"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function show($id)
    {
        return $this->response(Routine::find($id));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/routines/{id}",
     *     tags={"routines"},
     *     summary="Update an existing routine",
     *     description="Updates a routine by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the routine to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Routine updated successfully"
     *     ),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function update(Request $request, $id)
    {
        return $this->response($this->routineService->update($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/routines/{id}",
     *     tags={"routines"},
     *     summary="Delete a routine",
     *     description="Deletes a routine by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="The ID of the routine to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Routine deleted successfully"
     *     ),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function destroy($id)
    {
        return $this->response($this->routineService->destroy($id));
    }
}
