<?php

namespace App\Http\Controllers;

use App\Course;
use App\Enrollment;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return response()->json(Course::all());
    }


    public function show($slug)
    {
        $course = Course::with('ratings','enrollments', 'user')
            ->where('slug',$slug)
            ->get();
        return response()->json($course );
    }
}
