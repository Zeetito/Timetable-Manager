<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // LogIn function
    public function login(Request $request){
        
        // Validate the login credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Get the authenticated user
            $user = Auth::user();

            // Create a new personal access token for the user
            $token = $user->createToken('authToken')->plainTextToken;

            // Return success response with the token
            return response()->json([
                'status' => 'success',
                'user' => $user,
                'token' => $token
            ], 200);
        } else {
            // Return error response for failed login
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid login credentials'
            ], 401);
        }
        
    }

    // logout function
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Logout successful'
        ], 200);
    }
}
