<?php

namespace App\Http\Controllers;

use App\Course;
use App\Enrollment;
use App\Notifications\NewSubscription;
use App\Payement;
use App\User;
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
        $enrollments = Enrollment::with('course.user')->where('user_id', $request->user()->id)->get();
        return response()->json($enrollments);
    }

    /**
     * Display a listing of specific course enrollments.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseEnrollments($id)
    {
        $enrollments = Enrollment::where('course_id', $id);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $enrollment = new Enrollment();
        $enrollment->user_id = $request->user()->id;
        $enrollment->course_id = $request['course_id'];
        $enrollment->save();
        if ($enrollment) {
            $payment = new Payement();
            $payment->enrollment_id = $enrollment->id;
            $payment->user_id = $request->user()->id;
            $payment->amount = $request['course_price'];
            $payment->method = $request['paymentMethod'];
            $payment->object = $request['course_name'];
            $payment->save();
        }
        $course = Course::find($request['course_id']);
        $teacher = $course->user_id;
        $user = User::find($teacher);
        $user->notify(new NewSubscription());

        return response()->json("Enrolled successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
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
     * @param int $id
     * @return \Illuminate\Http\Response
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
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->user_id = $request->user()->id;
        $enrollment->course_id = $request['course_id'];

        $enrollment->save();
        return response()->json($enrollment);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, Request $request)
    {
        $enrollment = Enrollment::findOrFail($id);
        if ($enrollment->user_id === $request->user()->id) {
            $enrollment->delete();
            return response()->json(["response" => "success"]);
        }
        return response()->json(["response" => "unauthorized"]);
    }
}
