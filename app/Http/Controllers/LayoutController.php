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

    public function createOpportunity()
    {
        return view('opportunities/createOpp');
    }

    public function readOpportunity()
    {
        return view('opportunities/readOpp');
    }

    public function updateOpportunity()
    {
        return view('opportunities/updateOpp');
    }

    public function loginPage()
    {
        return view('layouts/login');
    }

}
