<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Payement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PayementController extends Controller
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

        $payements = Payement::all();
        return response()->json($payements);
    }
    public function received()
    {
        $received = Payement::where('type', 'received')->get();
        return response()->json($received);
    }
    public function sent()
    {
        $sent = Payement::where('type', 'sent')->get();
        return response()->json($sent);
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
        $payment = new Payement();
        $payment->enrollment_id = $request['enrollment_id'];
        $payment->user_id = $request->user()->id;
        $payment->amount = $request['amount'];
        $payment->save();
        return response()->json($payment);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $payment = Payement::find($id);
        return response()->json($payment);
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
        $payment = Payement::find($id);
        if (!$payment->user_id=== $request->user()->id) {
            return response()->json(["response" => "unauthorized"], 403);
        }
        $payment->enrollment_id = $request['enrollment_id'];
        $payment->user_id = $request['user_id'];
        $payment->amount = $request['amount'];
        $payment->save();
        return response()->json($payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payement::find($id);
        $payment->delete();
    }
}
