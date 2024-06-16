<?php

use App\Http\Controllers\Api\OpportunityController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:santum');

Route::get('all-opportunities', [OpportunityController::class, 'index']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    // Route::get('profile', [StudentController::class, 'profile']);
    Route::post('create-opportunity', [OpportunityController::class, 'store']);
    Route::get('list-opportunities', [OpportunityController::class, 'showAll']);
    Route::get('single-opportunity/{id}', [OpportunityController::class, 'show']);
    Route::put('update-opportunity/{id}', [OpportunityController::class, 'update']);
    Route::delete('delete-opportunity/{id}', [OpportunityController::class, 'destroy']);

});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('opportunities', OpportunityController::class);
