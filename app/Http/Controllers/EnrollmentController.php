<?php

namespace App\Http\Controllers;

use App\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of enrollments.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $enrollments = Enrollment::all();
        return response()->json($enrollments);
    }
    /**
     * Display a listing of specific user enrollments.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userEnrollments(Request $request)
    {
        $enrollments = Enrollment::where('user_id', $request->user()->id);
        return response()->json($enrollments);
    }
    /**
     * Display a listing of specific course enrollments.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseEnrollments($id)
    {
        $enrollments = Enrollment::where('course_id',$id);
        return response()->json($enrollments);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $enrollment = new Enrollment();
        $enrollment->user_id = $request->user()->id;
        $enrollment->course_id = $request['course_id'];

        $enrollment->save();
        return response()->json($enrollment);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        return response()->json($enrollment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->user_id = $request->user()->id;
        $enrollment->course_id = $request['course_id'];

        $enrollment->save();
        return response()->json($enrollment);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, Request $request)
    {
        $enrollment =Enrollment::findOrFail($id);
        if($enrollment->user_id === $request->user()->id){
            $enrollment->delete();
            return response()->json(["response"=>"success"]);
        }
        return response()->json(["response"=>"unauthorized"]);
    }
}