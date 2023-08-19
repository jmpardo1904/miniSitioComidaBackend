<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth as JWTAuth;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {

        $user = User::where('email', $request['email'])->first();
        if (empty($user)) {
            return response()->json(["ok" => false]);
        }
        if (Hash::check($request['password'], $user->password)) {
            $token = JWTAuth::fromUser($user);
            return response()->json(["ok" => true, 'token' => $token,]);
        } else {
            return response()->json(["ok" => false]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/LoginForm');
    }
}
