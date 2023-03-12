<?php

namespace App\Http\Controllers\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait UserTrait {

    public function getLoggedUser(string $email): User {
        return User::where('email', $email)->first();
    }
}