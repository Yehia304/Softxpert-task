<?php

namespace App\Domain\User\Controllers;

use App\Domain\User\Requests\LoginRequest;
use App\Domain\User\Requests\RegisterRequest;
use App\Domain\User\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Request;
use \Illuminate\Http\JsonResponse;
use function Webmozart\Assert\Tests\StaticAnalysis\isEmptyArray;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $registerRequest): JsonResponse
    {
        $data = $this->authService->register($registerRequest);
        return response()->json([
            "message" => "User registered successfully",
            "user" => $data['user'],
            "token" => $data['token']
        ]);
    }


    public function login(LoginRequest $loginRequest) : JsonResponse
    {
        $data = $this->authService->login($loginRequest);

        if ($data) {
            return response()->json([
                "message" => "Logged in successfully",
                "user" => $data['user'],
                "token" => $data['token']
            ]);
        }

        return response()->json([
            "message" => "Invalid credentials"
        ], 401);
    }
}
