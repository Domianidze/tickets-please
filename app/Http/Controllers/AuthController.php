<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthorizeRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(AuthorizeRequest $request)
    {
        $validated = $request->validated()['data'];

        if (!Auth::attempt($validated)) {
            return response()->json(['message' => 'Invalid credentials.'], 401);
        }

        $user = User::firstWhere('email', $validated['email']);
        $token = $user->createToken('authorize')->plainTextToken;

        return response()->json([
            'message' => 'Authorized successfully.',
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Unauthorized successfully.',
        ], 200);
    }

    public function user(Request $request)
    {
        return UserResource::make($request->user());
    }
}
