<?php

namespace App\Http\Controllers;

use App\Role;
use App\SocialAccount;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
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
                'message' => 'incorrect password.'
            ], 401);
        }

        if (empty($user->email_verified_at)) {
            return response(["response" => "email unverified"], 403);
        }
        $token = $user->createToken('my-app-token')->plainTextToken;

        $role = $user->roles;
//        $role = Role::where('id', $role_id)->get();
        $response = [
            'user' => $user,
            'type' => $role,
            'token' => $token,
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
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function redirectToProvider($provider)
    {
        $url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
        return response()->json(['url' => $url]);
    }

    public function handleProviderCallback($provider)
    {

        // Get providers user data
        // @todo validate provider
        $provider_user = Socialite::driver($provider)->stateless()->user();
        $user = null;

//        dd($provider_user);

        // If no provider user, fail
        if (!$provider_user->token) {
            return response()->json('Authentication from ' . $provider . ' failed.', 422);
        }

        // Search for existing social account by provider user email
        $social_account = SocialAccount::where('provider_user_id', $provider_user->id)->where('provider', $provider)->first();

        // If there is no social account, we need to check if a user exists with provider user email
        if (!$social_account) {
            $user = User::where('email', $provider_user->email)->first();

            // If no user exists with provider user email, create new user
            if (!$user) {
                $user = $this->createUser($provider_user);
            }

            // Add provider social account for user
            $this->createSocialAccount($provider, $provider_user, $user);
        } // If there is a social account get it's user
        else {
            $user = User::findOrfail($social_account->user->id);
        }

        $token = $user->createToken('login token')->accessToken;
        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    /**
     * Create social account for user
     *
     * @return SocialAccount $social_account
     */
    private function createSocialAccount($provider, $provider_user, User $user)
    {
        $social_account = new SocialAccount();
        $social_account->provider = $provider;
        $social_account->provider_user_id = $provider_user->id;
        $social_account->user_id = $user->id;
        $social_account->save();
        return $social_account;
    }

    /**
     * Create user
     *
     * @return User $user
     */
    private function createUser($provider_user)
    {
        $user = new User();
        $name = explode(" ", $provider_user->name);
        $fname = $name[0];
        $lname = $name[1];
        $user->first_name = $fname;
        $user->last_name = $lname;
        $user->email = $provider_user->email;
        $user->headline = "my headline";
        $user->about = "about me";
        $user->image = $provider_user->avatar;
        $user->password = Hash::make(Str::random(12));
        $user->email_verified_at = now();
        $user->save();
        $studentR = Role::where('name', 'student')->first();
        $user->roles()->attach($studentR);

        return $user;
    }
}
