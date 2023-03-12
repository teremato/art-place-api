<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\UserTrait;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    use UserTrait;

    public function Login(LoginRequest $request) {

        $data = $request->input();
        $user = $this->getLoggedUser($data['email']);

        if(!$user) {
            return response()->json([
                'message' => ''
            ], Response::HTTP_BAD_REQUEST);
        }
        if(!Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => ''
            ], Response::HTTP_BAD_REQUEST);
        }

        $token = $user->createToken('auth')->plainTextToken;

        return response()->json([
            'message' => '',
            'user' => UserResource::make($user),
            'token' => $token
        ], Response::HTTP_OK);
    }
}
