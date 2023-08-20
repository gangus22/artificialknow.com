<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAttemptController
{
    public function __invoke(Request $request): JsonResponse
    {
        $loginCredentials = $request->validate([
            'username' => ['required', 'string', 'max:60'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        if (Auth::attempt($loginCredentials)) {
            $request->session()->regenerate();

            return response()->json(['redirect' => route('dashboard')]);
        }

        return response()->json();
    }
}
