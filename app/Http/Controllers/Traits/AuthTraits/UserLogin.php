<?php

namespace App\Http\Controllers\Traits\AuthTraits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

trait UserLogin {

    public function validateUserLogin(Request $request): array {
        return $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6']
        ]);
    }

    public function getLoginUser($email): User {
        return User::where('email', $email)->first();
    }

    public function checkPasswordValid(User $user, $password) {
        if(!Hash::check($password, $user->password)) {
            return response()->json([
                'message' => 'bed credits!'
            ], Response::HTTP_FORBIDDEN);
        }
    }
}