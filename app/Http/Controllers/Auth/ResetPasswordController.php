<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/dashboard'; // Where to redirect users after resetting password.

    public function showResetForm(string $token)
    {
        return view('auth.passwords.reset')->with(['token' => $token]);
    }
}