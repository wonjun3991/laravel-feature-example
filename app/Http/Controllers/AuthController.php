<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        $userDto = $request->toUserDto();
        $this->userService->createUser($userDto);
        return response()->json([
            'message' => 'success'
        ], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'The given data was invalid',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = User::whereEmail($credentials['email'])->first();
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json(['access_token' => $token]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'logout']);
    }
}
