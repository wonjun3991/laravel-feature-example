<?php

namespace App\Http\Controllers;

use App\Exceptions\AlreadyExistsException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Response;
use Illuminate\Routing\RouteDependencyResolverTrait;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $userDto = $request->toUserDto();
        try {
            $this->authService->register($userDto);
        } catch (AlreadyExistsException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['message' => '회원가입이 완료되었습니다.'], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        RouteDependencyResolverTrait::
        $credentials = $request->validated();
        $email = $credentials['email'];
        $password = $credentials['password'];

        if (!$this->authService->login($email, $password)) {
            return response()->json([
                'message' => '인증정보가 올바르지 않습니다.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $token = $this->authService->getToken($email);

        return response()->json([
            'message' => '로그인이 완료되었습니다.',
            'access_token' => $token
        ]);
    }

    public function logout()
    {
        $this->authService->logout();
        return response()->json(['message' => '로그아웃이 완료되었습니다.']);
    }

    public function profile()
    {
        $user = $this->authService->getProfile();
        return new UserResource($user);
    }
}
