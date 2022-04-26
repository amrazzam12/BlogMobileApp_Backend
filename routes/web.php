<?php

use App\Http\Controllers\DashboardPostsController;
use App\Http\Controllers\DashboardUsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::controller(DashboardUsersController::class)->prefix('admin/users')->group(function() {
    Route::get('/' , 'index');
    Route::get('/{user}' , 'edit')->name('users.edit');
    Route::put('/{user}' , 'update')->name('users.update');
    Route::delete('/{user}' , 'delete')->name('users.delete');
});

Route::controller(DashboardPostsController::class)->prefix('admin/posts')->group(function() {
    Route::get('/' , 'index');
    Route::delete('/{post}' , 'destroy')->name('posts.delete');
});
