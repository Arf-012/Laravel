<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create($validated);

        Auth::login($user);

        return $this->redirectByRole($user);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

       if (Auth::attempt($validated)) {
        $request->session()->regenerate();

        return $this->redirectByRole(Auth::user());
        }

       throw ValidationException::withMessages([
        'credentials' => 'Sorry, incorrect credentials'
       ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }

    public function redirectByRole(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('products.index'); // halaman admin
        } else {
            return redirect()->route('user.dashboard'); // halaman user biasa
        }
    }
}
