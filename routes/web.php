<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/sign-up', function () {
    
    abort_if(is_null('sign-up'), 404);

    return view('sign-up');
});

Route::get('/login', function () {
    
    // abort_if(is_null('login'), 404);

    return view('login');
});

Route::get('/dbconn', function () {
    return view('dbconn');
});

Route::post('/create', function(){
    User::create([
        'name' => request('name'),
        'phone' => request('phone'),
        'email'=> request('email'),
        'password' => request('password'),
        'user_type' => request('user_type'),
    ]);
    return redirect('/landing');
});
