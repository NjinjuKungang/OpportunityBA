<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\OpportunityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LayoutController::class, 'landingPage'] )->name('dashboard.landing');

Route::get('/sign-up', [LayoutController::class, 'signUpPage'])->name('sign-up');

Route::get('/login', [LayoutController::class, 'loginPage'])->name('login');

Route::get('/dashboard/applicant', [LayoutController::class, 'applicantPage'] )->name('dashboard.applicant');

Route::get('/dashboard/company', [LayoutController::class, 'companyPage'] )->name('dashboard.company');



Route::post('/sign-up', [AuthController::class, 'register'] )->name('authentication.sign-up');

Route::post('/login', [AuthController::class, 'login'] )->name('authentication.login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




Route::controller(OpportunityController::class)
    ->prefix('opportunity')
    ->name('pages.')
    ->group(function() {
        Route::get('/create', 'createPage')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/read/{id}', 'readPage')->name('view');
        Route::get('/update/{id}', 'editPage')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'destroy')->name('destroy');
    });



Route::get('/opportunity/apply/{id}', [ApplicationController::class, 'getApplication'])->name('apply');

Route::post('/opportunity/apply/{id}', [ApplicationController::class, 'postApplication'])->name('apply.post');
