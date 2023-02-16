<?php

namespace App\Http\Controllers\Traits\AuthTraits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

trait UserRegister {
    
    public function validateUserRegister(Request $request): array {
        return $request->validate([
            'name' => ['required', 'unique:users,name'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
        ]);
    }

    public function createUser($form): User {
        return User::create([
            'name' => $form['name'],
            'email' => $form['email'],
            'password' => Hash::make($form['password'])
        ]);
    }
}