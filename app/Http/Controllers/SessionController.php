<?php

namespace App\Http\Controllers;

use App\Services\SessionService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="sessions",
 *     description="API Endpoints of Sessions"
 * )
 */
class SessionController extends BaseController
{
    protected $sessionService;

    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/sessions",
     *     tags={"sessions"},
     *     summary="Get list of sessions",
     *     description="Returns list of sessions",
     *     operationId="index",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */
    public function index()
    {
        return $this->response($this->sessionService->index());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/sessions",
     *     tags={"sessions"},
     *     summary="Create new session",
     *     description="Stores a new session",
     *     operationId="store",
     *     @OA\RequestBody(
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Session created"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     )
     * )
     */
    public function store(Request $request)
    {
        return $this->response($this->sessionService->store($request->all()));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/sessions/{col}/{val}",
     *     tags={"sessions"},
     *     summary="Find session by column and value",
     *     description="Returns a single session",
     *     operationId="show",
     *     @OA\Parameter(
     *         name="col",
     *         in="path",
     *         required=true,
     *         description="Column name",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="val",
     *         in="path",
     *         required=true,
     *         description="Column value",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */
    public function show($col, $val)
    {
        return $this->response($this->sessionService->findColumn($col, $val));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/sessions/{id}",
     *     tags={"sessions"},
     *     summary="Update an existing session",
     *     description="Updates a session by ID",
     *     operationId="update",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Session ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Session updated"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        return $this->response($this->sessionService->update($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/sessions/{id}",
     *     tags={"sessions"},
     *     summary="Delete a session",
     *     description="Deletes a session by ID",
     *     operationId="destroy",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Session ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Session deleted"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */
    public function destroy($id)
    {
        return $this->response($this->sessionService->destroy($id));
    }
}