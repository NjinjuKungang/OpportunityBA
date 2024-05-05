<?php

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

