<?php

namespace App\Http\Controllers;

use App\Notifications\MailResetPasswordNotification;
use App\Notifications\VerifyEmail;
use App\Role;
use App\SocialAccount;
use App\User;
use Carbon\Carbon;
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
            'password' => 'required',
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
        $user->image = "https://firebasestorage.googleapis.com/v0/b/instaclass-9f27f.appspot.com/o/profiles%2Fuserprofiile.jpg?alt=media&token=f5bb81d3-ffbf-4cc5-8817-1d38e69ad2ce";
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
    public function redirectToProvider(Request $request, $provider)
    {
        info('redirectToProvider');
        Cache::put('social_type', $request['type'], 600);
        $url = Socialite::driver($provider)->stateless()->with(['type' => $request['type']])->redirect()->getTargetUrl();
        return response()->json(['url' => $url]);
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        info('handleProviderCallback');
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
            $user = User::where('email', $provider_user->email)->with('roles')->first();

            // If no user exists with provider user email, create new user
            if (!$user) {
                info('created user');
                $user = $this->createUser($provider_user);
                info('created user');
            }
            info('user', [$user]);
            // Add provider social account for user
            $found = User::where('id', $user->id)->with('roles')->first();
            if(!empty($found) && !is_null($found)){
                $this->createSocialAccount($provider, $provider_user, $found);
            }
            info('!$social_account');
            $token = $found->createToken('login token')->plainTextToken;
            return response()->json(['user' => $found, 'token' => $token], 200);
        } // If there is a social account get it's user
        else {
            info('$social_account');
            $user = User::with('roles')->findOrfail($social_account->user->id);
            $token = $user->createToken('login token')->plainTextToken;
            return response()->json(['user' => $user, 'token' => $token], 200);
        }
    }

    public function handleSocialAuth(Request $request)
    {
        $user = User::where('email', $request['email'])->with('roles')->first();

        // If no user exists with provider user email, create new user
        if (!$user) {
            $user = $this->createSocialUser($request->all());
            info('created user');
        }
       
        $found = User::where('id', $user->id)->with('roles')->first();
        $token = $found->createToken('login token')->plainTextToken;
        return response()->json(['user' => $found, 'token' => $token], 200);
    }

    /**
     * Create user
     *
     * @return User $user
     */
    private function createSocialUser(array $data)
    {
        $user = new User();
        $name = explode(" ", $data['name']);
        $fname = $name[0];
        $lname = $name[1];
        $user->first_name = $fname;
        $user->last_name = $lname;
        $user->email = $data['email'];
        $user->image = "https://firebasestorage.googleapis.com/v0/b/instaclass-9f27f.appspot.com/o/profiles%2Fuserprofiile.jpg?alt=media&token=f5bb81d3-ffbf-4cc5-8817-1d38e69ad2ce";
        $user->password = Hash::make(Str::random(12));
        $user->email_verified_at = now();
        $user->save();
        
        $studentR = Role::where('name', $data['role'])->first();
        $user->roles()->attach($studentR);
        return $user;
    }

    /**
     * Create social account for user
     *
     * @return SocialAccount $social_account
     */
    private function createSocialAccount($provider, $provider_user, $user)
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
            $token = Str::random(30);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            info('token create');
            info($token);
            $user->notify(new MailResetPasswordNotification($token));
            return Response()->json(["message" => "Password reset email sent."]);
        }
        return Response()->json(["messageFR" => "E-mail ne correspond pas à nos enregistrements", "messageEN" => "Email don't match our records"], 404);
    }


    /*
     * Reset the given user's password.
     */
    protected function resetPassword(Request $request)
    {
        info($request->all());
        info($request->token);
        $tokenData = DB::table('password_resets')->where('token', $request->token)->first();
        $user = User::where('email', $tokenData->email)->first();
        if ($user) {
            $user->update([
                "password" => Hash::make($request->password)
            ]);

            DB::table('password_resets')->where('token', $request->token)->delete();
            return Response()->json(["message" => "Password reset succeeded"]);
        }
        return Response()->json(["message" => "user not found"], 404);


    }

}
