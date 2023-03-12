<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\RegisterTrait;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;

class RegisterController extends Controller
{

    use RegisterTrait;

    public function Register(RegisterRequest $request) {

        $data = $request->input();
        $user = $this->createUser($data);

        if($request->hasFile('avatar')) {
            $user->addMedia($request->file('avatar'))
                ->toMediaCollection('avatar');
        }

        $token = $user->createToken('auth')->plainTextToken;

        return response()->json([
            'message' => '',
            'user' => UserResource::make($user),
            'token' => $token
        ], Response::HTTP_OK);
    }
}
