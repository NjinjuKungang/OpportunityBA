<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\OpportunityController;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [LayoutController::class, 'landingPage'] )->name('landing');

Route::get('/sign-up', [LayoutController::class, 'signUpPage'])->name('sign-up');

Route::get('/login', [LayoutController::class, 'loginPage'])->name('login');

Route::post('/sign-up', [AuthController::class, 'register'] )->name('sign-up.post');

Route::post('/login', [AuthController::class, 'loginPost'] )->name('login.post');

Route::get('/applicantHome', [AuthController::class, 'applicantPage'] )->name('applicant');

Route::get('/companyHome', [AuthController::class, 'companyPage'] )->name('company');

Route::get('/createOpp', [LayoutController::class, 'createOpportunity'])->name('create');

Route::get('/readOpp', [LayoutController::class, 'readOpportunity'])->name('view');

Route::get('/updateOpp', [LayoutController::class, 'updateOpportunity'])->name('edit');

Route::post('/companyHome', [OpportunityController::class, 'postOpportunity'] )->name('opportunity');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
