<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function logout()
    {
        auth()->logout();
        return redirect()->route('auth.login');
    }
}
