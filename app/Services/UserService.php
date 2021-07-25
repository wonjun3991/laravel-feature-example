<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getUserList()
    {
        return User::with(['catType', 'catPatternType'])->get();
    }

    public function findUser(int $id)
    {
        return User::with(['catType', 'catPatternType'])->findOrFail($id);
    }
}
