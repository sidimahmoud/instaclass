<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Course;
use App\Enrollment;
use App\Http\Controllers\Controller;
use App\Payement;
use App\Rating;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function teachers()
    {
        $teachers = User::whereHas(
            'roles', function ($q) {
            $q->where('name', 'teacher')
                ->where("active", 1);
        }
        )->get();
        return response()->json($teachers);
    }

    public function students()
    {
        $students = User::whereHas(
            'roles', function ($q) {
            $q->where('name', 'student')
                ->where("active", 1);
        }
        )->get();
        return response()->json($students);
    }

    public function admins()
    {
        $admins = User::whereHas(
            'roles', function ($q) {
            $q->where('name', 'admin')
                ->where("active", 1);
        }
        )->get();
        return response()->json($admins);
    }

    public function banned()
    {
        $banned = User::where('active', 0)->get();
        return response()->json($banned);
    }

    public function banish($id)
    {
        $user = User::find($id);
        $user->active = false;
        $user->save();
        return response()->json("Banned successfully");
    }
    public function unblock($id)
    {
        $user = User::find($id);
        $user->active = true;
        $user->save();
        return response()->json("Banned successfully");
    }

    public function addSpeciment(Request $request)
    {
        $user = $request->user();
        $user->speciment = $request['speciment'];
        $user->save();
        return response()->json("Speciment added successfully");
    }

    public function counts()
    {
        $categories = Category::count();
        $courses = Course::count();
        $teachers = User::whereHas(
            'roles', function ($q) {
            $q->where('name', 'teacher');
        }
        )->get()->count();
        $students = User::whereHas(
            'roles', function ($q) {
            $q->where('name', 'student');
        }
        )->get()->count();

        return response()->json(['categories' => $categories, 'courses' => $courses, 'teachers' => $teachers, 'students' => $students,]);
    }

    //return a list of non paid teacher courses
    public function teacherCourses($id)
    {
        $courses = Course::where('user_id', $id)->where('paid', 0)->get();
        return response()->json($courses);
    }

    public function teacherDetails(Request $request)
    {
        $user = $request->user();
        $students = DB::select("select distinct count(id) as count from enrollments e where e.course_file_id in(select id from course_files where id in(select id from courses where user_id=$user->id) )");
        $ratings = Rating::with('user')->where('teacher_id', $user->id)->get();
        return response()->json(["students" => $students, "ratings" => $ratings]);
    }

    public function teacherPayments(Request $request)
    {
        $payments = Payement::where([
            ['enrollment.course.user_id', $request->user()->id],
            ['type', 'received'],
        ])->get();
        return response()->json($payments);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $id = $request->user()->id;
        $user = User::with('enrollments', "ratings")->where('id', $id)->get();
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);

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
//        dd($request->all());
        $user = User::find($id);
        $user->first_name = $request["first_name"];
        $user->last_name = $request["last_name"];
        $user->phone = $request["phone"];
        $user->country = $request["country"];
        $user->city = $request["city"];
        $user->email = $request["email"];
//        $user->password = $request["password"];
        if ($request->hasFile('image')) {
            $file = $request['image'];
            $extension = $file->getClientOriginalExtension();
            $file_name = $request['name'] . "-" . time() . "." . $extension;
            $file->move('uploads/profiles/', $file_name);
            $user->image = '/uploads/profiles/' . $file_name;
        }
        $user->about = $request["about"];
        $user->languages = $request["languages"];
        $user->save();
        if ($user) return response()->json(["response" => "Updated successfully"]);
        return response()->json(["response" => "error"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return response()->json("deleted");
    }
}
