<?php

namespace App\Http\Controllers;

use App\Notifications\VerifyEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify($user_id, Request $request) {
        $user = User::find($user_id);
        $user->email_verified_at = Carbon::now();
        $user->save();
//        if ($user->role-)
        return redirect("/auth/login");
    }

    public function resend($user_id, Request $request) {
        if (auth()->user()->hasVerifiedEmail()) {
            return response()->json(["msg" => "Email already verified."], 400);
        }
        $request->user()->notify(new VerifyEmail());
        return response()->json(["msg" => "Email verification link sent on your email id"]);
    }
}
