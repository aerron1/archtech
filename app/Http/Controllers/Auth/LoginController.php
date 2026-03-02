<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // IMPORTANT: Add is_active condition to credentials
        // This is the key fix - Auth::attempt will fail for inactive users
        $credentials['is_active'] = true;

      if (Auth::attempt([
    'email' => $request->email,
    'password' => $request->password,
    'is_active' => true,
])) {
    $request->session()->regenerate();
    return redirect()->intended(route('admin.dashboard'));
}


        // Check if user exists but is inactive
        $user = User::where('email', $request->email)->first();
        if ($user && !$user->is_active) {
            throw ValidationException::withMessages([
                'email' => 'Your account has been disabled. Please contact an administrator.',
            ]);
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
