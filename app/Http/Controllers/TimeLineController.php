<?php

namespace App\Http\Controllers;

use App\Services\TimeLineService;
use Illuminate\Http\Request;

class TimeLineController extends Controller
{
    protected $timeLineService;

    public function __construct(TimeLineService $timeLineService)
    {
        $this->timeLineService = $timeLineService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/time-lines",
     *     summary="Get all timelines",
     *     tags={"TimeLines"},
     *     @OA\Response(
     *         response=200,
     *         description="List of timelines"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(["message" => "The operation was successfully!", "timeLine" => $this->timeLineService->getTimeLines()]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/time-lines",
     *     summary="Create a new timeline",
     *     tags={"TimeLines"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"start_date","end_date","goal","status"},
     *             @OA\Property(property="start_date", type="string", format="date"),
     *             @OA\Property(property="end_date", type="string", format="date"),
     *             @OA\Property(property="goal", type="string"),
     *             @OA\Property(property="status", type="string", enum={"planned","done"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Timeline created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'goal' => 'required|string',
            'status' => 'required|in:planned,done',
        ]);

        return response()->json($this->timeLineService->createTimeLine($data), 201);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/time-lines/{id}",
     *     summary="Update a timeline",
     *     tags={"TimeLines"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="start_date", type="string", format="date"),
     *             @OA\Property(property="end_date", type="string", format="date"),
     *             @OA\Property(property="goal", type="string"),
     *             @OA\Property(property="status", type="string", enum={"planned","done"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Timeline updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Timeline not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date',
            'goal' => 'sometimes|string',
            'status' => 'sometimes|in:planned,done',
        ]);

        return response()->json($this->timeLineService->updateTimeLine($id, $data));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/time-lines/{id}",
     *     summary="Delete a timeline",
     *     tags={"TimeLines"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Timeline deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Timeline not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        return response()->json($this->timeLineService->deleteTimeLine($id));
    }
}
