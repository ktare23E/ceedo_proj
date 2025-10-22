<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        // return $request->all();
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            switch ($user->user_type) {
                case 'Admin':
                    return redirect()->intended(route('dashboard'));
                // case 'Customer':
                //     return redirect()->intended(route('auth_welcome'));
                // case 'Treasury':
                //     return redirect()->intended(route('treasury_dashboard'));
                // case 'Tourism':
                //     return redirect()->intended(route('tourism_dashboard'));
                    // default:
                    //     return redirect()->intended(route('welcome'));
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
