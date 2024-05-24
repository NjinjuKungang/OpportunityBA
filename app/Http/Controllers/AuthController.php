<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{

    public function logout(Request $request): RedirectResponse {
        
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('dashboard.landing');

    }
    
    public function register(Request $request): RedirectResponse 
    {
        $validated = $request->validate(
            [
            'name' => ['required'],
            'phone' => ['required'],
            'email'=> ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
            'user_type' => ['required'],
            'category' => ['required_if:user_type, applicant'],
        ]);

            //Hash password
        $request['password'] = bcrypt($request['password']);


        $user = new User();
        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $user->email = $validated['email'];
        $user->password = $validated['password'];
        $user->user_type = $validated['user_type'];
        if($user->user_type == 'applicant') {
            $user->catgory = $validated['category'];
        }

        $user->save();

        auth()->login($user);

        if($user->user_type == 'applicant') {
            return redirect()->route('dashboard.applicant')->with("message", "Your account has been created successfully!!!");
        }
        else {
            return redirect()->route('dashboard.company')->with("message", "Your account has been created successfully!!!");
        }

    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if(Auth()->user()->user_type == 'applicant'){
                return redirect()->route('dashboard.applicant');
            }
            else{
                return redirect()->route('dashboard.company');
            }
        }

 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

}


