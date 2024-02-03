<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        Log::warning($request);

        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'age' => $request->age,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User successfully registered', 'user' => $user]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        Log::debug(print_r($credentials, true));

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $request->session()->regenerate();
        return response()->json(Auth::user());

    }

    public function logout(Request $request)
    {
        // セッションを無効化してユーザーをログアウトする
//    Auth::logout();
        $request->session()->invalidate();

        // 再生成して古いセッションとトークンを無効にするために再生成
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'User successfully logged out']);
    }
}
