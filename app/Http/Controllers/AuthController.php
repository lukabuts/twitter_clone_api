<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();


        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
        ]);

        // Auto-login: create token right away
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'token' => $token,
            'user' => $user,
        ]);

    }

    public function login(LoginRequest $request)
    {
        $credentials = $this->getCredentials($request);
    
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
    
        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        
        // Revoke all tokens for the user
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    protected function getCredentials($request)
    {
        $login = $request->input('login');
    
        // Determine if login is email or username
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    
        return [
            $field => $login,
            'password' => $request->input('password')
        ];
    }
}
