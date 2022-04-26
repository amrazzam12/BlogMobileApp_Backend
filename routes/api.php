<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CommentsController;
use App\Http\Controllers\Api\PostsController;
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
            Route::get('/{id}' , 'show')->where('id' ,'[0-9]+');
            Route::put('/{user}' , 'update');
            Route::get('/my-profile' , 'profile');
    // Routes That Required Authentication
    });

Route::controller(PostsController::class)->middleware('auth:sanctum')
    ->prefix('posts')->group(function () {
        Route::get('/' , 'index');
        Route::get('/{post}' , 'show')->where('post' , '[0-9]+');
        Route::post('/' , 'store');
        Route::put('/{post}' , 'update');
        Route::delete('/{post}' , 'destroy');

});

Route::controller(PostsController::class)->middleware('auth:sanctum')
        ->prefix('likes')->group(function () {
            Route::get('/{post}' ,  'getLikes');
            Route::post('/{post}' ,  'toggleLike');
});

Route::controller(  CommentsController::class)->prefix('comments')->group(function () {
    Route::get('/post/{id}' , 'postComments');
    Route::get('/user/{id}' , 'userComments');
});





