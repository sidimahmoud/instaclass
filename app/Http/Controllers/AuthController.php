<?php

namespace App\Http\Controllers;

use App\Notifications\MailResetPasswordNotification;
use App\Notifications\VerifyEmail;
use App\Role;
use App\SocialAccount;
use App\User;
use http\Env\Response;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
//    use ResetsPasswords;
    use SendsPasswordResetEmails;

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
//            $user->sendEmailVerificationNotification();
            return response(["message" => "email unverified"], 403);
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
            if ($request["type"] === "teacher") {
                $role = Role::where('name', 'teacher')->first();
                $user->roles()->attach($role);
            } else {
                $role = Role::where('name', 'student')->first();
                $user->roles()->attach($role);
            }
            $user->notify(new VerifyEmail($user->id));

            return response()->json($user);
        }
        return response()->json("error");
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function redirectToProvider(Request $request,$provider)
    {
        Cache::put('social_type',$request['type'], 600);
        $url = Socialite::driver($provider)->stateless()->with(['type' => $request['type']])->redirect()->getTargetUrl();
        return response()->json(['url' => $url]);
    }

    public function handleProviderCallback(Request $request, $provider)
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

        $token = $user->createToken('login token')->plainTextToken;
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
        $user->image = $provider_user->avatar;
        $user->password = Hash::make(Str::random(12));
        $user->email_verified_at = now();
        $user->save();
        $valueType = Cache::get('social_type', 'student');
        info('user', [$valueType]);
        $studentR = Role::where('name', $valueType)->first();
        info('role', [$studentR]);
        $user->roles()->attach($studentR);
        //delete session type
        return $user;
    }

    /**
     * Send password reset link.
     */
    public function sendPasswordResetLink(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $token = Str::random(60);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
            ]);
            $user->notify(new MailResetPasswordNotification($token));
        }
        return Response()->json(["message" => "Password reset email sent."]);
    }


    /*
     * Reset the given user's password.
     */
    protected function resetPassword(Request $request)
    {
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();
        $user = User::where('email', $tokenData->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        DB::table('password_resets')->where('token', $request->token)->delete();
        return Response()->json(["message" => "Password reset succeeded"]);
    }

}
