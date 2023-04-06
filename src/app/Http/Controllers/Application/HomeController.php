<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $title = "Home - Welcome to demo app";
        return view('app.home', compact('title'));
    }
}
