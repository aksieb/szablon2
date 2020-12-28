<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate(array(
            'email'             => 'required|email',
            'password'          => 'required|min:8'
        ));

        $remember = $request->input('remember');
        $email = $request->input('email');
        $password = $request->input('password');
        $passwordHashed = hash('sha256', $password);

        $user = User::where('email', $email)
            ->first();

        if ($user && $user->password == $passwordHashed) {
            Auth::login($user, $remember);
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Nieprawidłowy email/hasło!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate(array(
            'email'             => 'required|max:255|email|unique:users',
            'password'          => 'required|min:8|confirmed',
            'first_name'        => 'required|max:255',
            'last_name'         => 'required|max:255'
        ));

        User::create(array(
            'email'             => $request->input('email'),
            'password'          => hash('sha256', $request->input('password')),
            'first_name'        => $request->input('first_name'),
            'last_name'         => $request->input('last_name')
        ));

        session()->flash('source', 'successful_register');

        return redirect('/login');
    }
}
