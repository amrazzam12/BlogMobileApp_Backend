<?php

namespace App\Services;

use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthServices
{

    use ApiTrait;

     public function loginIn($request)
     {
        $credentials = $request->all();



        if (Auth::guard('user')->attempt($credentials)){
            $user = Auth::guard('user')->user();
            $token = $user->createToken('token')->plainTextToken;
            //$token =  $request->user()->createToken('token')->plainTextToken;
            return $this->returnData('success' , 'Logged In' , [
                'user' => $user,
                'token' => $token
            ]);
        }
        return $this->returnError( 'Not Found' );
    }


    public function register($request): JsonResponse
    {
        $data = $request->all();
        $validate = Validator::make($data, $request->rules()); // Just To Remove Yellow Error Line  :)

        if (! $validate->fails()){
            DB::table('users')->insert([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),

            ]);

            return $this->loginIn($request);

        }

        return $this->returnError( "Error" ); // Request Exception Occurred When Resister Fails

    }


    public function logout(Request $request): JsonResponse
    {

         if (!$request->user()->tokens())
             return $this->returnError('No User Found !');

        $request->user()->tokens()->delete();

        return $this->returnSuccess('User Logged Out !');

    }

}
