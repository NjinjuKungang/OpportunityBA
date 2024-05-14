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

    public function applicantPage()
    {
        return view('layouts/applicantHome');
    }

    public function companyPage()
    {
        return view('layouts/companyHome');
    }

    public function logout(Request $request): RedirectResponse {
        
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('landing'));

    }
    
    public function register(Request $request){
        $request->validate(
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
            $user->name =$request['name'];
            $user->phone =$request['phone'];
            $user->email =$request['email'];
            $user->password =$request['password'];
            $user->user_type =$request['user_type'];
            if($user->user_type == 'applicant') {
                $user->catgory =$request['category'];
            }

            $user->save();


            auth()->login($user);

            if($user->user_type == 'applicant') {
                    return redirect(route('applicant'))->with("message", "!!! Your account has been created successfully");
                }
                else {
                    return redirect(route('company'))->with("message", "!!! Your account has been created successfully");
                }

        }

//         public function login(Request $request){
            
//             $credentials = $request->validate([
//                 'email' => ['required', 'email'],
//                 'password' => ['required'],
//             ]);
                    
//             if(Auth::attempt($credentials)){
//                 if($user->user_type == 'applicant') {
                    
//                     $request->session()->regenerate();
//                     return redirect()->intended('applicant');
//                 }
//                 else {
//                     $request->session()->regenerate();
//                     return redirect()->intended('applicant');
//                 }
//             }
        
//             return back()->withErrors([
//                 'email' => 'The provided credentials do not match our records.',
//             ])->onlyInput('email');
//         }
        
}




        // $User = User::create(
        //     [
        //     'name' => request('name'),
        //     'phone' => request('phone'),
        //     'email'=> request('email'),
        //     'password' => request('password'),
        //     'user_type' => request('user_type'),
        //     'catgory' => request('category'),
        // ]);

    //     $User->save();

    //     if($User->user_type == 'applicant') {
    //         return redirect()->route('applicant')->with("message", "!!! Your account has been created successfully");
    //     }
    //     else {
    //         return redirect()->route('company')->with("message", "!!! Your account has been created successfully");

    //     }
    // }

    






