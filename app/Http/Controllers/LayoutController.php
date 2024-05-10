<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LayoutController extends Controller
{
    public function landingPage()
    {
        return view('layouts/landing');
    }

    public function signUpPage()
    {
        return view('layouts/sign-up');
    }

    public function loginPage()
    {
        return view('layouts/login');
    }
}
