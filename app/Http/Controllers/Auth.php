<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Iluminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Data\LoginData;
use App\Services\AuthService; 
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

class Auth extends Controller
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = AuthService::getInstance();
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request, LoginRequest $loginRequest, LoginData $loginData)
    {
        return $this->authService->authenticate($loginData);
    }

    /**
     * Log the user out (Revoke the token).
     */
    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }

    /**
     * Get the authenticated User.
     */
    public function user(Request $request)
    {
        return $this->authService->getUser($request);
    }
}
