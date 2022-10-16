<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginAuthRequest $request)
    {

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'ok' => true,
            'token' => $token,
            'usuario' => $user
        ]);
    }

    public function refresh()
    {
        $usuario = Auth::user();
        $usuario->currentAccessToken()->delete();
        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'ok' => true,
            'token' => $token,
            'usuario' => $usuario,
        ], 200);
    }

    public function logout()
    {
        $usuario = Auth::user();
        $usuario->tokens()->delete();
        return response()->json([
            'ok' => true,
            'msg' => 'User Logout'
        ]);
    }
}
