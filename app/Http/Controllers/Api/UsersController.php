<?php

namespace App\Http\Controllers\Api;

use App\Services\authServices;
use App\Services\UserServices;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\users\StoreUserRequest;
use App\Models\User;
use App\Traits\ApiTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    use ApiTrait;


    public function index()
    {
        return (new UserServices)-> getAllUsers();
    }

    public function show($id)
    {
        return (new UserServices)->getSpecificUser($id);
    }


    public function store(RegisterRequest $request): JsonResponse
    {
        return (new AuthServices)->register($request);
    }

    public function update(Request $request , User $user)
    {
        return (new UserServices)->updateUser($request , $user);
    }

    public function profile(Request $request): JsonResponse
    {
        return (new UserServices)->getMyProfile($request);
    }
}
