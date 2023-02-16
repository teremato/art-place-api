<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\AuthTraits\UserLogin;
use App\Http\Controllers\Traits\AuthTraits\UserRegister;
use App\Http\Resources\UserResourse;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    use UserLogin,
        UserRegister;

    
    public function register(Request $request) {

        $form = $this->validateUserRegister($request);
        $user = $this->createUser($form);

        return response()->json([
            'user' => UserResourse::make($user),
            'token' => $user->createToken($form['email'])
                            ->plainTextToken
        ], Response::HTTP_OK);
    }

    public function login(Request $request) {

        $form = $this->validateUserLogin($request);
        $user = $this->getLoginUser($form['email']);
        
        $this->checkPasswordValid($user, $form['password']);

        return response()->json([
            'user' => UserResourse::make($user),
            'token' => $user->createToken($form['email'])
                            ->plainTextToken
        ], Response::HTTP_OK);
    }

    public function logout(Request $request) {

        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'message' => 'logout succes!'
        ], Response::HTTP_OK);
    }
}