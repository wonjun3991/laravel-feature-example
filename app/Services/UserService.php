<?php

namespace App\Services;

use App\Exceptions\AlreadyExistsException;
use App\Exceptions\BadRequestException;
use App\Exceptions\DataNotFoundException;
use App\Models\CatPatternType;
use App\Models\CatType;
use App\Models\User;
use App\Services\Dto\UserDto;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getUserList()
    {
        return User::with(['catType', 'catPatternType'])->get();
    }
    
    public function createUser(UserDto $dto)
    {
        if ($this->isExistEmail($dto->getEmail())) {
            throw new AlreadyExistsException($dto->getEmail());
        }

        $user = new User();
        $user->email = $dto->getEmail();
        $user->password = Hash::make($dto->getPassword());
        $user->age = $dto->getAge();
        $user->cat_pattern_type_id = $this->getCatPatternType($dto->getCatPatternType());
        $user->cat_type_id = $this->getCatType($dto->getCatType());
        $user->save();
    }

    public function findUser(int $id)
    {
        return User::with(['catType', 'catPatternType'])->findOrFail($id);
    }

    private function getCatPatternType(string $catPatternType): int
    {
        return CatPatternType::whereType($catPatternType)->firstOrFail()->id;
    }

    private function getCatType(string $catType): ?int
    {
        return CatType::whereType($catType)->firstOrFail()->id;
    }

    private function isExistEmail(string $email): bool
    {
        return User::whereEmail($email)->exists();
    }
}
