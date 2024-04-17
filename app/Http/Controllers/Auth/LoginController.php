<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index()
    {
        return auth()->user() ? redirect()->route('dashboard') : view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return back()->with('error', 'Invalid credentials');
        }
        return redirect()->intended(route('dashboard'))->with('success', 'Login successful');
    }

    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::updateOrCreate([
            'email' => $githubUser->email,
        ], [
            'github_id' => $githubUser->id,
            'name' => $githubUser->name ?? $githubUser->nickname,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
        auth()->login($user);
        return redirect()->intended(route('dashboard'))->with('success', 'Login successful');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('login')->with('success', 'Logout successful');
    }
}
