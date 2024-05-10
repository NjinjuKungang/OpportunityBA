<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayoutController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [LayoutController::class, 'landingPage'] )->name('landing');

Route::get('/sign-up', [LayoutController::class, 'signUpPage']);

Route::get('/login', [LayoutController::class, 'loginPage']);

Route::post('/sign-up', [AuthController::class, 'register'] )->name('sign-up');
// Route::post('/sign-up', function(){
//     User::create([
//         'name' => request('name'),
//         'phone' => request('phone'),
//         'email'=> request('email'),
//         'password' => request('password'),
//         'user_type' => request('user_type'),
//     ]);
//     return redirect('/landing');
// });
