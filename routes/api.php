<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('users', App\Http\Controllers\API\UserAPIController::class);


Route::resource('clients', App\Http\Controllers\API\ClientAPIController::class);


Route::resource('projects', App\Http\Controllers\API\ProjectAPIController::class);


Route::resource('tasks', App\Http\Controllers\API\TaskAPIController::class);


Route::resource('project_statuses', App\Http\Controllers\API\ProjectStatusAPIController::class);
