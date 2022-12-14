<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('/authors');
        } else {
            return back()->withErrors(['credentials' => true]);
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect('/');
    }
}
