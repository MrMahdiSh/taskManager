<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Services\SessionService;
use App\Models\Session;
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
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"type", "title", "content", "day_id"},
     *             @OA\Property(property="type", type="string", description="Type of the session"),
     *             @OA\Property(property="title", type="string", description="Title of the session"),
     *             @OA\Property(property="content", type="string", description="Content of the session"),
     *             @OA\Property(property="date", type="date")
     *         )
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
        $validatedData = $request->validate([
            'type' => 'required|string|in:daily,weekly,monthly',
            'title' => 'required|string',
            'date' => 'nullable|string',
            'content' => 'required|string'
        ]);

        if (!isset($validatedData["date"]))
            $validatedData["date"] = now()->toDateString();

        // find the day
        $day = Day::where("date", $validatedData["date"])->first();

        if (!$day) {
            $this->sessionService->createDay($validatedData["date"]);
            $day = Day::where("date", $validatedData["date"])->first();
        }

        $validatedData["day_id"] = $day->id;

        // Check if the type is daily and if a session already exists for the day
        if ($validatedData['type'] === 'daily') {
            $existingSession = Session::where('day_id', $day->id)->where('type', 'daily')->first();
            if ($existingSession) {
                // Update the existing session
                return $this->response($this->sessionService->update($existingSession->id, $validatedData));
            }
        }

        $validatedData["date"] = null;

        return $this->response($this->sessionService->store($validatedData));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/sessions/{id}",
     *     tags={"sessions"},
     *     summary="Get a specific session",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(
     *         response=200,
     *         description="A specific session"
     *     ),
     *     @OA\Response(response=404, description="Not Found"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function show($id)
    {
        return $this->response(Session::find($id));
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
        $session = Session::find($id);

        if (!$session) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        $validatedData = $request->validate([
            'type' => 'required|string|in:daily,weekly,monthly',
            'title' => 'required|string',
            'date' => 'nullable|string',
            'content' => 'required|string'
        ]);

        if (!isset($validatedData["date"])) {
            $validatedData["date"] = now()->toDateString();
        }

        // find the day
        $day = Day::where("date", $validatedData["date"])->first();

        if (!$day) {
            return response()->json(['error' => 'Day not found'], 404);
        }

        $validatedData["day_id"] = $day->id;
        $validatedData["date"] = null;

        return $this->response($this->sessionService->update($validatedData, $id));
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
