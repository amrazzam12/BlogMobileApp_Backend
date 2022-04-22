<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\UsersController;
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


Route::controller(AuthController::class)->group(function () {
    Route::post('login' , 'login');
    Route::post('register' , 'register');
    Route::post('logout' , 'logout')->middleware('auth:sanctum');
});


Route::controller(UsersController::class)->middleware('auth:sanctum')
    ->prefix('users')->group(function (){
    // Routes That Required Authentication
            Route::put('/{user}' , 'update');
            Route::get('/my-profile' , 'profile');
    // Routes That Required Authentication
    });

