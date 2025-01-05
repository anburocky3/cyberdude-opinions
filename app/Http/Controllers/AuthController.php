<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        $githubUser = Socialite::driver('github')->user();
        
        // If the user doesn't exist create, else update the existing one
        $user = User::updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'provider_id' => $githubUser->getId(),
            'name' => $githubUser->getName() ?? $githubUser->getNickname(),
            'email' => $githubUser->getEmail(),
            'username' => $githubUser->getNickname(),
            'avatar' => $githubUser->avatar,
            'token' => $githubUser->token,
            'refresh_token' => $githubUser->refreshToken,
        ]);

        Auth::login($user, true);

        return redirect()->intended();
    }
}
