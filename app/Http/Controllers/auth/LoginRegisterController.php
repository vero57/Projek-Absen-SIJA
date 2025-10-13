<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;

class LoginRegisterController extends Controller
{
    public function showLoginRegister()
    {
        return view('auth.login-register');
    }
}
