<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use App\Enrollment;
use App\Rating;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Repositories\CourseRepository;

class CourseController extends Controller
{
    private $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        /* $courses = Course::with('subCategory.category', 'sections')->paginate(10);
        return response()->json($courses); */
        if (request()->has('all')) {
            $courses = $this->courseRepository->all();
        } else {
            $courses = $this->courseRepository->paginate();
        }
        return response()->json($courses, 201);
    }

    public function show($id)
    {
        $course = Course::with('sections.enrollments', 'user', 'subCategory.category')
            ->where('id', $id)
            ->first();
        $ratings = Rating::where('teacher_id', $course->user_id)->get();
        return response()->json(["course" => $course, "ratings" => $ratings]);
    }

    public function filter()
    {
        $courses = QueryBuilder::for(Course::class)
            ->allowedFilters([
                AllowedFilter::exact('language'),
                AllowedFilter::scope('price_less_than'),
                AllowedFilter::scope('in_category')
            ])
            ->allowedIncludes(['ratings.user', 'sections.enrollments', 'user', 'subCategory.category'])
            ->allowedSorts('created_at')
            ->paginate(25);
        return response()->json($courses);
    }

    public function categoryCourses($id)
    {
        $cat = Category::find($id)->subCategories()->get('id');
        $courses = Course::whereIn('sub_category_id', $cat)->with('subCategory.category', 'sections')->get();
        return response()->json($courses);
    }

    public function courseSectionsCount($count)
    {
        $courses = Course::with('subCategory.category', 'sections')->withCount('sections')->having('sections_count', '>=', $count)->get();
        return response()->json($courses);
    }

    public function search($search)
    {
        $courses = Course::with('subCategory.category')
            ->where('name', 'ilike', "%" . "$search" . "%")
            ->orWhere('description', 'ilike', "%" . $search . "%")
            ->get();
        return response()->json($courses);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEnrollements(int $id)
    {
        $courses = $this->courseRepository->getEnrollements($id);
    
        return response()->json($courses, 201);
    }
}
