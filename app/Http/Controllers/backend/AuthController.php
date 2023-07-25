<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($loginData)) {
            return response(['message'=>'Invalid credentials']);
        }

        if(auth()->user()->type != 'admin'){
            return response(['message'=>'Invalid authority']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        try {
            $result = $request->user()->token()->revoke();
            if (!$result) {
                throw new \Exception('Try again', 500);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Logged Out Successfully'
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
