<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $userList = $this->userService->getUserList();
        return UserResource::collection($userList);
    }

    public function show(int $id)
    {
        $user = $this->userService->findUser($id);
        return new UserResource($user);
    }
}
