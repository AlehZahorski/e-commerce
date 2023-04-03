<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public function register(Request $request): JsonResponse
    {
        if (User::query()->where('email',$request->email)->first()) {
            return response()->json([
                'status' => false,
                'message' => 'This email already exist.'
            ], 409);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $token = $user->createToken('MyAppToken')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'User successfully registered',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Inputs',
                'error' => $validator->errors()
            ], 422);
        }

        if (empty(User::query()->where('email', $request->email)->first())) {
            return response()->json([
                'status' => false,
                'code' => 404,
                'message' => 'User not found',
            ], 200);
        } else if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('MyAppToken')->plainTextToken;
            $minutes = 1440;
            $timestamp = now()->addMinute($minutes);
            $expires_at = date('M d, Y H:i A', strtotime($timestamp));
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Login successful',
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_at' => $expires_at
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'code' => 403,
                'message' => 'Password is wrong',
            ], 200);
        }
    }

    public function logout(): JsonResponse
    {
        $user = auth('sanctum')->user();
        if ($user !== null) {
            $user->currentAccessToken()->delete();
            return response()->json([
                'status' => true,
                'message' => 'Logout successful'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Access-token not found'
            ], 404);
        }

    }
}
