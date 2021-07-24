<?php

namespace App\Http\Controllers;

use App\Exceptions\AlreadyExistsException;
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
        try {
            $this->userService->createUser($userDto);
        } catch (AlreadyExistsException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['message' => '회원가입이 완료되었습니다.'], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => '인증정보가 올바르지 않습니다.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = User::whereEmail($credentials['email'])->first();
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => '로그인이 완료되었습니다.',
            'access_token' => $token
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => '로그아웃이 완료되었습니다.']);
    }
}
