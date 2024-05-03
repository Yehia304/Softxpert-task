<?php

namespace App\Domain\User\Services;

use App\Domain\User\Repositories\UserRepository;
use App\Domain\User\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register($data) : array
    {
        $user = $this->userRepository->create($data);
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            "user" => $user,
            "token" => $token
        ];
    }

    public function login($request) : array
    {
        if(Auth::attempt($request->only(['email', 'password']))) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return [
                "user"=> $user,
                "token"=> $token
            ];
        }
        return [];
    }
}
