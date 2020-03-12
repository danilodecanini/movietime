<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'email|required|string|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User created succesfully'
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required|string',
            'password' => 'required|string'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials))
            return response()->json([
                'status' => 'error',
                'message' => 'Access denied'
            ], 401);

        $user = $request->user();
        $token = $user->createToken('Access Token')->accessToken;

        return response()->json([
            'status' => 'success',
            'token' => $token
        ], 200);

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'status' => 'success',
            'message' => 'Token revoked'
        ], 200);
    }
}
