<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function landingPage(): View
    {
        $opportunities = Opportunity::get();
        return view('dashboard/landing', ['opportunities' => $opportunities]);
    }

    public function signUpPage(): View
    {
        return view('authentication/sign-up');
    }

    public function loginPage(): View
    {
        return view('authentication/login');
    }

    public function applicantPage(): View
    {
        $users = Auth::user();
        $opportunities = Opportunity::where('category', $users->catgory)->get();
        return view('dashboard.applicant', ['opportunities' => $opportunities]);
    }

    public function companyPage(): View
    {
        $id = Auth::id();
        $opportunities = Opportunity::where('user_id', $id)->get();
        return view('dashboard.company', ['opportunities' => $opportunities]);
    }
    
}
