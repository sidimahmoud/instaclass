<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseFile;
use App\Enrollment;
use App\Notifications\NewSubscription;
use App\Notifications\OneDayBeforeClass;
use App\Payement;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

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
        $enrollments = Enrollment::with('CourseFile.course.user')->where('user_id', $request->user()->id)->get();
        return response()->json($enrollments);
    }

    /**
     * Display a listing of specific course enrollments.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseEnrollments($id)
    {
        $enrollments = Enrollment::with("user")->where('course_file_id', $id)->get();
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
     * @throws \Exception
     */
    public function store(Request $request) //enroll in one session
    {
        $sec = CourseFile::find($request['section_id']);
        $enrollment = new Enrollment();
        $enrollment->user_id = $request->user()->id;
        $enrollment->course_file_id = $request['section_id'];
        $enrollment->save();
        if ($enrollment) {
            if ($this->transaction($request->all())) {
                $payment = new Payement();
                $payment->enrollment_id = $enrollment->id;
                $payment->user_id = $request->user()->id;
                $payment->amount = $request['course_price'];
                $payment->method = $request['paymentMethod'];
                $payment->object = $request['course_name'];
                $payment->save();
            } else return response()->json("Charge error", 500);
        }
        $teacher = $sec->course->user_id;
        $user = User::find($teacher);
        $user->notify(new NewSubscription($sec->title));

        $startDate = str_replace("T", " ", $sec->startDate);
        $when = Carbon::parse($startDate)->subDays(1);
        $request->user()->notify((new OneDayBeforeClass($startDate))->delay($when));

        return response()->json("Enrolled successfully");
    }


    public function EnrollInAllSections(Request $request)
    {
        $course = Course::find($request["course_id"])->first();

        $sections = $course->sections;

        $enrollment = new Enrollment();
        $enrollment->user_id = $request->user()->id;
        $enrollment->course_id = $course->id;
        $enrollment->save();
        if ($this->transaction($request->all())) {
            $payment = new Payement();
            $payment->enrollment_id = $enrollment->id;
            $payment->user_id = $request->user()->id;
            $payment->amount = $request['course_price'];
            $payment->method = $request['paymentMethod'];
            $payment->object = $request['course_name'];
            $payment->save();

            foreach ($sections as $section) {
                $startDate = str_replace("T", " ", $section->startDate);
                $when = Carbon::parse($startDate)->subDays(1);
                $request->user()->notify((new OneDayBeforeClass($startDate))->delay($when));
            }
        } else return response()->json("Charge error", 500);

        $teacher = $course->user_id;
        $user = User::find($teacher);
        $user->notify(new NewSubscription("Number: " . $course->id));

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

    public function transaction(array $data)
    {
        \Stripe\Stripe::setApiKey(config("payment.key"));
        $charge = \Stripe\Charge::create([
            "amount" => $data["course_price"] * 100,
            "currency" => "CAD",
            "description" => "Instaclass payment",
            "source" => $data["token"]
        ]);

        return $charge;

    }
}
