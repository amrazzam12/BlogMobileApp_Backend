<?php

namespace App\Http\Controllers\Api\Auth;

use App\Services\authServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Traits\ApiTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AuthController extends Controller
{

    use ApiTrait;

    public function login(Request $request)
    {
        return (new authServices )->loginIn($request);
    }


    public function register(RegisterRequest $request): JsonResponse
    {
        return (new authServices)->register($request);
    }

    public function logout(Request $request): JsonResponse
    {

        return (new authServices)->logout($request);

    }
}
