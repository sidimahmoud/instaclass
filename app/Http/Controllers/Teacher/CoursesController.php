<?php

namespace App\Http\Controllers\Teacher;

use App\Course;
use App\CourseFile;
use App\Enrollment;
use App\Http\Controllers\Controller;
use App\Mail\Mails;
use App\Payement;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        $course = new Course();
        $course->user_id = $request->user()->id;
        $course->sub_category_id = $request["sub_category_id"];
        $course->name = $request["name"];
        $course->short_description = $request["short_description"];
        $course->description = $request["description"];
        $course->image = $request["image"];
        $course->slug = Str::slug($request["name"], "-");
        $course->language = $request["language"];
        $course->status = 2;
        $course->type = 2;
        $course->estimated_duration = $request["estimated_duration"];
        $course->authorized_students = $request["authorized_students"];
        $course->join_after = $request["join_after"];
        $course->price = $request["price"];
        $course->currency = $request["currency"];
        $course->available_from = $request["available_from"];
        $course->available_to = $request["available_to"];
        $course->sharable = $request["sharable"];
        $course->published = 1;

        if ($request->hasFile('image')) {
            $file = $request['image'];
            $extension = $file->getClientOriginalExtension();
            $file_name = $request['name'] . "-" . time() . "." . $extension;
            $file->move('uploads/categories/', $file_name);
            $course->image = 'uploads/courses/thumbnails' . $file_name;
        }
        $course->save();

        if ($course)
            $sections = json_decode($request["sections"]);
        foreach ($sections as $key => $section) {
            $courseSection = new CourseFile();
            $courseSection->course_id = $course->id;
            $courseSection->title = $section->title;
            $courseSection->description = $section->description;
            $courseSection->startDate = $section->stratDate;
            $courseSection->duration = $section->duration;
            $courseSection->save();
        }
        if ($course){
            Mail::to("medab.vall@gmail.com.com")->send(new Mails());

//            Mail::to("clem2001@hotmail.com")->send(new Mails());
//            Mail::to("nyveline87@yahoo.fr")->send(new Mails());
        }

            return response()->json("course created successfully");
        return response()->json("error");
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
        $course->user_id = $request->user()->id;
        $course->category_id = $request["category_id"];
        $course->name = $request["name"];
        $course->short_description = $request["short_description"];
        $course->description = $request["description"];
        $course->image = $request["image"];
        $course->slug = $request["slug"];
        $course->language = $request["language"];
        $course->duration = $request["duration"];
        $course->status = $request["status"];
        $course->type = $request["type"];
        $course->estimated_duration = $request["estimated_duration"];
        $course->authorized_students = $request["authorized_students"];
        $course->join_after = $request["join_after"];
        $course->price = $request["price"];
        $course->available_from = $request["available_from"];
        $course->available_to = $request["available_to"];
        $course->sharable = $request["sharable"];
        $course->published = $request["published"];

        if ($request->hasFile('image')) {
            $file = $request['image'];
            $extension = $file->getClientOriginalExtension();
            $file_name = $request['name'] . "-" . time() . "." . $extension;
            $file->move('uploads/categories/', $file_name);
            $course->image = 'uploads/courses/thumbnails' . $file_name;
        } else
            $course->image = $request['image'];
        $course->save();

        if ($course)
            return response()->json("course created successfully");
        return response()->json("error");
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
