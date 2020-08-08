<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response([
                'message' => 'This Email  do not match our records.'
            ], 404);
        }
        if ($user && !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'incorrect passwerd.'
            ], 401);
        }
        foreach ($user->tokens as $token) {
            $token->delete();

        }
        if (empty($user->email_verified_at)) {
            return response(["response"=>"email unverified"], 403);
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => "required|string",
            'last_name' => "required|string",
            'email' => "required|email|unique:users",
            'password' => "required",
            'image' => "",
            'about' => "",
        ]);

        $user = new User();
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->image = $request['image'];
        $user->about = $request['about'];
        $user->save();

        if ($user) {
            $user->sendEmailVerificationNotification();
            return response()->json("success");
        }
        return response()->json("error");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $user = $request->user();
        return response()->json($user);
    }
}
