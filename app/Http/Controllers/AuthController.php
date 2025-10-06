<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $login = $request->input('email'); // 'email' field can contain username or email
        $password = $request->input('password');

        // Try to login with email
        $credentials = ['email' => $login, 'password' => $password];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/movie');
        }

        // If email login fails, try username
        $user = User::where('name', $login)->first();
        if ($user) {
            $credentials = ['email' => $user->email, 'password' => $password];
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/movie');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}