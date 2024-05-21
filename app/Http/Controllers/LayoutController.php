<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function landingPage()
    {
        $opportunities = Opportunity::get();
        return view('layouts/landing', compact('opportunities'));
    }

    public function signUpPage()
    {
        return view('layouts/sign-up');
    }

    public function loginPage()
    {
        return view('layouts/login');
    }

    public function applicantPage()
    {
        $users = Auth::user();
        $opportunities = Opportunity::where('category', $users->catgory)->get();
        return view('layouts/applicant-dashboard', compact('opportunities'));
    }

    public function companyPage()
    {
        $users = Auth::user()->id;
        $opportunities = Opportunity::where('user_id', $users)->get();
        return view('layouts/company-dashboard', compact('opportunities'));
    }
    
}
