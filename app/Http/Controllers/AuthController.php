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
            'email' => $githubUser->getEmail(),
        ], [
            'provider_id' => $githubUser->getId(),
            'name' => $githubUser->getName() ?? $githubUser->getNickname(),
            'avatar' => $githubUser->avatar,
            'token' => $githubUser->token,
        ]);

        Auth::login($user, true);

        return redirect()->intended();
    }
}
