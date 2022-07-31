<?php

namespace App\Http\Controllers\APi\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\Api\UserResource;

class LoginController extends BaseController
{
    public function Login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($credentials)){

            $token = request()->user()->createToken('login_token');
            return ['user' => UserResource::make(auth()->user()), 'token' => $token->plainTextToken];
        }else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
}
