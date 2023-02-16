<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResourse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request) {
        
        $user = $request->user();
        $token = $request->bearerToken();

        if(!$user){
            return Response::HTTP_FORBIDDEN;
        }

        return response()->json([
            'user' => UserResourse::make($user),
            'token' => $token
        ], Response::HTTP_OK);
    }
}
