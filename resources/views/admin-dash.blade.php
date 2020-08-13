<?php


use App\SocialAccount;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
// @todo validate provider
        $redirect_url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();

        return response(['redirect_url' => $redirect_url], 200);
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

        $token = $user->cre
        return response()->json(['user' => $user], 200);
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
            'image' => $provider_user->avatar,
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

