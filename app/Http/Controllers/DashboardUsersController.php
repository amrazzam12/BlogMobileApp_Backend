<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\Request;

class DashboardUsersController extends Controller
{
    public function index() {
        return (new UserServices('NormalRequest'))->getAllUsers(); // Get All Users In A Blade File
    }

    public function edit(User $user){
        return view('users.edit' , compact('user'));
    }
     public function update(Request $request , User $user) {
        return (new UserServices('normalRequest'))->updateUser($request , $user);
     }
    public function delete(User $user) {
        return (new UserServices('normalRequest'))->deleteUser($user);
    }
}
