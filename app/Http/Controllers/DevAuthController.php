<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DevAuthController extends Controller
{
    public function showLoginForm()
    {
        if (session('is_developer')) {
            return redirect()->route('dev.index');
        }
        return view('dev.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Default credentials for the dev environment
        // In production, this should be in .env or a dedicated database table
        $validUsername = env('DEV_USERNAME', 'admin@jtech');
        $validPassword = env('DEV_PASSWORD', 'admin@jtech');

        if ($request->username === $validUsername && $request->password === $validPassword) {
            session(['is_developer' => true]);
            return redirect()->route('dev.index');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        session()->forget('is_developer');
        return redirect()->route('dev.login');
    }
}
