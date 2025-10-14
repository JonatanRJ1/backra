<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Data\LoginData;
use App\Data\GenericResponseData;
use App\Models\User;

class AuthService
{
    private static ?AuthService $instance = null;

    private function __construct() {
      
    }
    
    // Static method to get the singleton instance
    public static function getInstance(): AuthService
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(LoginData $loginData): GenericResponseData
    {
        try {
            $user = User::where('email', $loginData->email)->first();

            if (! $user || ! Hash::check($loginData->password, $user->password)) {
                return new GenericResponseData(
                    status: false,
                    message: 'The provided credentials are incorrect.',
                    code: 401
                );
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return new GenericResponseData(
                status: true,
                message: 'Authentication successful',
                code: 200,
                data: [
                    'user' => $user,
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ]
            );
        } catch (\Exception $e) {
            return new GenericResponseData(
                status: false,
                message: 'Error during authentication',
                code: 500,
                error: $e->getMessage()
            );
        }
    }

    /**
     * Log the user out (Revoke the token).
     */
    public function logout(Request $request): GenericResponseData
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return new GenericResponseData(
                status: true,
                message: 'Logged out successfully.',
                code: 200
            );
        } catch (\Exception $e) {
            return new GenericResponseData(
                status: false,
                message: 'Error during logout',
                code: 500,
                error: $e->getMessage()
            );
        }
    }

    /**
     * Get the authenticated User.
     */
    public function getUser(): GenericResponseData
    {
        $user = auth()->user();
        try {
            return new GenericResponseData(
                status: true,
                message: 'User retrieved successfully',
                code: 200,
                data: $user
            );
        } catch (\Exception $e) {
            return new GenericResponseData(
                status: false,
                message: 'Error retrieving user',
                code: 500,
                error: $e->getMessage()
            );
        }
    }
    
}