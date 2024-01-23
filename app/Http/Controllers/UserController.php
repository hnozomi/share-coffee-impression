<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        Log::info($request);
        // リクエストのバリデーション

        try {
            $validatedData = $request->validate([
                'userName' => 'required|string|max:255',
                'password' => 'required|string|min:6',
                'age' => 'required|integer',
            ]);

            // ユーザーの作成
            $user = User::create([
                'userName' => $validatedData['userName'],
                'password' => Hash::make($validatedData['password']),
                'age' => $validatedData['age'],
            ]);

            // 応答を返す
            return response()->json(['message' => 'User successfully registered', 'user' => $user]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'User unsuccessfully registered'], 500);
        }
    }

    public function login(Request $request)
    {
        Log::info($request);
        // リクエストのバリデーション

        try {
            $validatedData = $request->validate([
                'userName' => 'required|string|max:255',
                'password' => 'required|string|min:6',
            ]);
            if (Auth::attempt(['userName' => $validatedData['userName'], 'password' => $validatedData['password']])) {
                // 認証成功
                return response()->json(['message' => 'Login successful']);
            } else {
                // 認証失敗
                return response()->json(['message' => 'Login failed'], 401);
            }
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'Login unsuccessfully registered'], 500);
        }
    }
}
