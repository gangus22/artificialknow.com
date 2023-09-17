<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class LoginController extends Controller
{
    public function __invoke(): RedirectResponse|InertiaResponse
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return Inertia::render('LoginPage');
    }
}
