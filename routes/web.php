<?php

use App\Http\Controllers\ApplicationController;
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

Route::get('/{id}/applicantHome', [AuthController::class, 'applicantPage'] )->name('applicant');

Route::get('{id}/companyHome', [AuthController::class, 'companyPage'] )->name('company');

Route::get('/createOpp', [LayoutController::class, 'createOpportunity'])->name('create');

Route::post('/createOpp', [OpportunityController::class, 'postOpportunity'] )->name('create.post');

Route::get('/readOpp/{opportunity}', [LayoutController::class, 'readOpportunity'])->name('view');

Route::get('/updateOpp/{opportunity}', [LayoutController::class, 'updateOpportunity'])->name('edit');

Route::put('/updateOpp/{opportunity}', [LayoutController::class, 'updateOpp'])->name('edit.post');

Route::get('/delete/{opportunity}', [LayoutController::class, 'deleteOpportunity'])->name('delete');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/apply/{opportuity}', [ApplicationController::class, 'getApplication'])->name('apply');

Route::post('/apply/{opportuity}', [ApplicationController::class, 'postApplication'])->name('apply.post');
