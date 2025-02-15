<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:128',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'id' => \Illuminate\Support\Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User created successfully'], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'token' => $token,
            'expires_in' => JWTAuth::factory()->getTTL() * 60 
        ]);
    }

    // **Получение данных о пользователе**
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    // **Выход (инвалидируем токен)**
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }

    // **Обновление токена**
    public function refresh()
    {
        return response()->json([
            'token' => JWTAuth::refresh(),
            'expires_in' => JWTAuth::getTTL() * 60 // используем getTTL для получения времени жизни токена
        ]);
    }
}
