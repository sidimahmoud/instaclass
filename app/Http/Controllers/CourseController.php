<?php

namespace App\Http\Controllers;

use App\Course;
use App\Enrollment;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $courses = Course::with('category')->paginate(2);
        return response()->json($courses);
    }


    public function show($slug)
    {
        $course = Course::with('ratings.user', 'enrollments', 'user')
            ->where('slug', $slug)
            ->get();
        return response()->json($course);
    }

    public function categoryCourses($id)
    {
        $course = Course::with('category')->where('category_id', $id)->get();
        return response()->json($course);
    }
    public function search($search)
    {
        $courses = Course::with('category')->where('name', 'like', "%"."$search"."%")
            ->orWhere('description', 'like', "%".$search."%")
            ->get();
        return response()->json($courses);

    }
}
