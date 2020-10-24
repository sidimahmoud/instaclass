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
        $courses = Course::with('subCategory.category', 'sections')->paginate(10);
        return response()->json($courses);
    }


    public function show($slug)
    {
        $course = Course::with('ratings.user', 'sections.enrollments', 'user', 'subCategory.category')
            ->where('id', $slug)
            ->get();

        return response()->json($course);
    }

    public function subCategoryCourses($id)
    {
        $course = Course::with('subCategory.category')->where('sub_category_id', $id)->get();
        return response()->json($course);
    }

    public function search($search)
    {
        $courses = Course::with('subCategory.category')
            ->where('name', 'ilike', "%" . "$search" . "%")
            ->orWhere('description', 'ilike', "%" . $search . "%")
            ->get();
        return response()->json($courses);

    }
}
