<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    /**
     * Login a user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = request(['phone', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        } elseif (Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Authorized'
            ], 200);
        }

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addYear(); // set expiry time to 1 year from now
        $token->save();

        return response()->json([
            'message' => 'Successfully authenticated',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    }

    public function register(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'gender' => 'required',
            'campus_area' => 'required',
            'password' => 'required',
        ]);

        // Create the new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'slug' => $request->input('slug') . '-' . $request->input('name'),
            'campus_area' => $request->input('campus_area'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Return a response or redirect as needed
        return response()->json(['message' => 'User created successfully'], 201);
    }


    /**
     * Logout a user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out'], 200)
            ->cookie('laravel_session', null, -1, '/', null, false, true);
    }
}
