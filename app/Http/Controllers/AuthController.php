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

        // Check if a user with the same email already exists
        $existingUser = User::where('email', $githubUser->getEmail())->first();

        if ($existingUser) {
            // Update the user's information
            $existingUser->update([
                'provider_id' => $githubUser->getId(),
                'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                'username' => $githubUser->getNickname(),
                'email' => $githubUser->getEmail(),
                'avatar' => $githubUser->avatar,
                'token' => $githubUser->token,
                'refresh_token' => $githubUser->refreshToken,
            ]);


            // If the user exists, log them in without updating
            Auth::login($existingUser, true);

            if ($existingUser->role == 'admin') {
                return redirect()->route('admin.index');
            }
        } else {
            // If the user doesn't exist, create a new one
            $user = User::updateOrCreate([
                'github_id' => $githubUser->id,
            ], [
                'provider_id' => $githubUser->getId(),
                'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                'username' => $githubUser->getNickname(),
                'email' => $githubUser->getEmail(),
                'avatar' => $githubUser->avatar,
                'token' => $githubUser->token,
                'refresh_token' => $githubUser->refreshToken,
            ]);

            Auth::login($user, true);
        }

        return redirect()->intended();
    }
}
