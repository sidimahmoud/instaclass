<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {

        // Get providers user data
        // @todo validate provider
        $provider_user = Socialite::driver($provider)->stateless()->user();
        $user = null;

// dd($provider_user);

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
        return response()->json(['user' => $user, 'token'=>$token], 200);
    }

    /**
     * Create social account for user
     *
     * @return SocialAccount $social_account
     */
    private function createSocialAccount($provider, $provider_user, User $user)
    {
        $social_account = SocialAccount::create([
            'provider' => $provider,
            'provider_user_id' => $provider_user->id,
            'user_id' => $user->id,
        ]);

        return $social_account;
    }

    /**
     * Create user
     *
     * @return User $user
     */
    private function createUser($provider_user)
    {
        $user = User::create([
            'first_name' => $provider_user->name,
            'email' => $provider_user->email,
            'password' => Hash::make(Str::random(12)),
            'email_verified_at' => now(),
        ]);

        return $user;
    }
}