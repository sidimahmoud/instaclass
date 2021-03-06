<?php

namespace App\Http\Controllers;

use App\Course;
use App\Rating;
use http\Env\Response;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of specific course ratings.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $rates = Rating::with('user','teacher')->get();
        return Response()->json($rates);

    }

    public function courseRates($id)
    {
        $rates = Rating::where('course_id', $id);
        return Response()->json($rates);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rate = new Rating();
        $rate->course_id = $request["course_id"];
        $rate->rate = $request["rate"];
        $rate->review = $request["review"];
        $rate->user_id = $request->user()->id;
        $rate->save();
        if ($rate)
            return response()->json("success");
        return response()->json("error", 500);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $rating = Rating::findOrFail($id);
        return response()->json($rating);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rate = Rating::findOrFail($id);
        $rate->course_id = $request["course_id"];
        $rate->rate = $request["rate"];
        $rate->user_id = $request->user()->id;
        $rate->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, Request $request)
    {
        $rate = Rating::findOrFail($id);
        if ($rate->user_id === $request->user()->id) {
            $rate->delete();
            return response()->json(["response" => "success"]);
        }
        return response()->json(["response" => "unauthorized"]);
    }
}
