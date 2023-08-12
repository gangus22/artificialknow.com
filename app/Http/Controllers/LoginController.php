<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function view(): View
    {
        return view('login');
    }

    public function attemptLogin(Request $request): RedirectResponse
    {
        $loginCredentials = $request->validate([
            'username' => ['required', 'string', 'max:60'],
            'password' => ['required', 'string', 'password'],
        ]);

        if (Auth::attempt($loginCredentials)) {
            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back(401);
    }
}
