<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Services\DayService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="days",
 *     description="Operations about days"
 * )
 */
class DayController extends BaseController
{
    protected $dayService;

    public function __construct(DayService $dayService)
    {
        $this->dayService = $dayService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/days",
     *     tags={"days"},
     *     summary="Get all days with routines",
     *     @OA\Response(
     *         response=200,
     *         description="A list of days with routines"
     *     ),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function index()
    {
        return $this->response($this->dayService->getAllWithRoutines());
    }

    /**
     * @OA\Post(
     *     path="/api/v1/days",
     *     tags={"days"},
     *     summary="Store a new day",
     *     @OA\RequestBody(
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Day created successfully"
     *     ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function store(Request $request)
    {
        return $this->response($this->dayService->store($request->all()));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/days/{id}",
     *     tags={"days"},
     *     summary="Get a specific day by column and value",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(
     *         response=200,
     *         description="A specific day"
     *     ),
     *     @OA\Response(response=404, description="Not Found"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function show($id)
    {
        return $this->response(Day::find($id));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/days/selectByDate",
     *     tags={"days"},
     *     summary="Find a day by date",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"date"},
     *             @OA\Property(property="date", type="string", format="date", example="2025-06-26")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Day found successfully"
     *     ),
     *     @OA\Response(response=404, description="Not Found"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function selectByDate(Request $request)
    {
        $date = $request->input('date');
        $day = $this->dayService->findByDate($date);

        if (!$day) {
            return response()->json(['message' => 'Day not found'], 404);
        }

        return $this->response($day);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/days/{id}",
     *     tags={"days"},
     *     summary="Update an existing day",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Day updated successfully"
     *     ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=404, description="Not Found"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function update(Request $request, $id)
    {
        return $this->response($this->dayService->update($id, $request->all()));
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/days/{id}",
     *     tags={"days"},
     *     summary="Delete a day",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=204,
     *         description="Day deleted successfully"
     *     ),
     *     @OA\Response(response=404, description="Not Found"),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function destroy($id)
    {
        return $this->response($this->dayService->destroy($id));
    }
}
