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
use Illuminate\Support\Facades\DB;

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
        info('info',[$request->user()->id]);
        $enrollments = Enrollment::where('user_id', $request->user()->id)->with('CourseFile.course.user')->get();
        info('enrollments',[$enrollments]);
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
            if ($request['course_price'] > 0)
                $this->transaction($request->all());
            $payment = new Payement();
            $payment->enrollment_id = $enrollment->id;
            $payment->user_id = $request->user()->id;
            $payment->amount = $request['course_price'];
            $payment->method = $request['paymentMethod'];
            $payment->object = $request['course_name'];
            $payment->save();
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
        $requestedSections = $request["sections"];
        foreach($requestedSections as $id) {
            $enrollment = new Enrollment();
            $enrollment->user_id = $request->user()->id;
            $enrollment->course_id = $course->id;
            $enrollment->course_file_id = $id;
            $enrollment->save();
        }
        if (!empty($request['course_price'])) {
            \Stripe\Stripe::setApiKey(config('payment.key'));

            $token = $request['token'];
        
            $charge = \Stripe\Charge::create([
                'amount' => $request['course_price'] * 100,
                'currency' => 'cad',
                'description' => 'Payment instantaclasse.ca',
                'source' => $token,
            ]);
        }

        $payment = new Payement();
        $payment->enrollment_id = $enrollment->id;
        $payment->user_id = $request->user()->id;
        $payment->amount = $request['course_price'];
        $payment->method = $request['paymentMethod'];
        $payment->object = $request['course_name'];
        $payment->save();
        
        $teacher = $course->user_id;
        $user = User::find($teacher);
        if(!is_null($user)){
            $user->notify(new NewSubscription("Number: " . $course->id));
        }
        return response()->json("Enrolled successfully");
    }

    public function upcomingClasses(Request $request)
    {
        $user_id = $request->user()->id;
        $s = DB::select("select * from course_files where id in (select course_file_id from enrollments where user_id = $user_id) UNION SELECT * FROM course_files where course_id in (select course_id enrollments )");
        $sections = Enrollment::whereHas('user', function ($query) use ($user_id) {
                $query->where('id', $user_id);
            })
            ->whereHas('CourseFile', function ($query) {
                $query->orderBy('startDate', 'ASC');
            })
            ->with('CourseFile')
            ->get();
        return response()->json($sections);
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

    public function deleteAllEnrollement() {
        $data = Enrollment::truncate();

        return response()->json([]);
    }
}
