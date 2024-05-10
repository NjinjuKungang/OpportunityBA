<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function register(){
        $User = User::create(
            [
            'name' => request('name'),
            'phone' => request('phone'),
            'email'=> request('email'),
            'password' => request('password'),
            'user_type' => request('user_type'),
        ]
    );
        $User->save();
        return redirect()->route('landing');
    }
}
