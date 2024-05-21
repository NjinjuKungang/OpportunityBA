<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\OpportunityController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LayoutController::class, 'landingPage'] )->name('landing');

Route::get('/sign-up', [LayoutController::class, 'signUpPage'])->name('sign-up');

Route::get('/login', [LayoutController::class, 'loginPage'])->name('login');

Route::get('/applicant-dashboard/{id}', [LayoutController::class, 'applicantPage'] )->name('applicant');

Route::get('/company-dashboard/{id}', [LayoutController::class, 'companyPage'] )->name('company');

Route::post('/sign-up', [AuthController::class, 'register'] )->name('sign-up.post');

Route::post('/login', [AuthController::class, 'loginPost'] )->name('login.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/opportunity/create', [OpportunityController::class, 'createPage'])->name('create');

Route::post('/opportunity/create', [OpportunityController::class, 'postPage'] )->name('create.post');

Route::get('/opportunity/read/{opportunity}', [OpportunityController::class, 'readPage'])->name('view');

Route::get('/opportunity/update/{opportunity}', [OpportunityController::class, 'editPage'])->name('edit');

Route::put('/opportunity/update/{opportunity}', [OpportunityController::class, 'updatePage'])->name('edit.post');

Route::get('/opportunity/delete/{opportunity}', [OpportunityController::class, 'deleteOpp'])->name('delete');

Route::get('/opportunity/apply/{opportuity}', [ApplicationController::class, 'getApplication'])->name('apply');

Route::post('/opportunity/apply/{opportuity}', [ApplicationController::class, 'postApplication'])->name('apply.post');
