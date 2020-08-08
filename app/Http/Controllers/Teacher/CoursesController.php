<?php

namespace App\Http\Controllers\Teacher;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }



    /**
     * Display a specific teacher courses.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function teacherCourses(Request $request)
    {
        if (Gate::denies('teacher-or-admin')) {
            return response()->json(["response" => 'unauthorized'], 403);
        }
        $user = $request->user();
        $courses = Course::where('user_id', $user->id)->get();
        return response()->json($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if (Gate::denies('teacher-or-admin')) {
            return response()->json(["response" => 'unauthorized']);
        }
        $course = new Course();
        $course->user_id =1 ;// $request->user()->id;
        $course->name = $request['name'];
        $course->description = $request['description'];
        $course->short_description = $request['short_description'];
        $course->sub_category_id = $request['sub_category_id'];
        $course->image = $request['image'];
        $course->status = $request['status'];
        $course->price = $request['price'];

        $course->save();
        return response()->json($course);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        $course->name = $request['name'];
        $course->description = $request['description'];
        $course->sub_category_id = $request['sub_category_id'];
        $course->status = $request['status'];
        $course->price = $request['price'];

        $course->save;

        return response()->json($course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
    }
}
