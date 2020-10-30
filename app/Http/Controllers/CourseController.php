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


    public function show($id)
    {
        $course = Course::with('ratings.user', 'sections.enrollments', 'user', 'subCategory.category')
            ->where('id', $id)
            ->get();
        return response()->json($course);
    }

    public function filter()
    {
        $courses = QueryBuilder::for(Course::class)
            ->allowedFilters([
                AllowedFilter::exact('language'),
                AllowedFilter::scope('price_less_than'),
                AllowedFilter::scope('in_category')
            ])
            ->allowedIncludes('ratings.user', 'sections.enrollments', 'user', 'subCategory.category')
            ->allowedSorts('created_at')
            ->paginate(25);
        return response()->json($courses);
    }

    public function categoryCourses($id)
    {

        $courses = Course::with('subCategory.category', 'sections')
            ->whereIn('sub_category_id', Category::find($id)->subCategories()->get('id'))->get();
        return response()->json($courses);
    }

    public function courseSectionsCount()
    {
        $courses = Course::whereHas('sections', function (Builder $query) {
            $query->count() > 3;
        });

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
}
