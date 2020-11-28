<?php

namespace App\Http\Controllers;

use App\CourseFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\CourseFileRepository;

class CourseFileController extends Controller
{
    private $courseRepository;

    public function __construct(CourseFileRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $files = CourseFile::where('course_id', $id);
        return response()->json($files);
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
        $file = new CourseFile();
        $file->course_id = $request['course_id'];
        $file->title = $request['title'];
        $file->description = $request['description'];
        $file->startDate = $request['startDate'];
        if ($request->hasFile('file')) {
            $sectionFile = $request['file'];
            $extension = $sectionFile->getClientOriginalExtension();
            $sectionFile_name = $request['title'] . "-" . time() . "." . $extension;
            $sectionFile->move('uploads/sections/', $sectionFile_name);
            $file->file = 'uploads/courses/sections' . $sectionFile_name;
        } else
            $file->file = $request['file'];
        $file->save();
        if ($file) return response()->json("Section created successfully");
        return response()->json("error");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $file = CourseFile::find($id);
        return response()->json($file);
    }

    public function upcomingSection(Request $request)
    {
        $id = $request->user()->id;
        $s = DB::select("select * from course_files where  id in (select id from courses where user_id = $id)");
        $sections = CourseFile::where("startDate", ">", Carbon::now())
            ->whereHas('course', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->orderBy('startDate', 'ASC')->get();
        return response()->json($sections);
    }

    public function teacherNextSection(Request $request)
    {
        $id = $request->user()->id;
        $s = DB::select("select * from course_files where  id in (select id from courses where user_id = $id)");
        $sections = CourseFile::where("startDate", ">", Carbon::now())
            ->whereHas('course', function ($query) use ($id) {
                $query->where('user_id', $id);
            })
            ->has('enrollments', '>=', 1)
            ->orderBy('startDate', 'ASC')->get();
        return response()->json($sections);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $file = CourseFile::find($id);
        $file->course_id = $request['course_id'];
        $file->file = $request['file'];
        $file->save();
        return response()->json($file);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $file = CourseFile::find($id);
        $file->delete();
        return response()->json(["response" => "section deleted"]);

    }

    public function updateLinks(Request $request, $id)
    {
        $cour = $this->courseRepository->update($request->all());
        return response()->json($cour);
    }
}
