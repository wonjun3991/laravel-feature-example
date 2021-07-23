<?php

namespace App\Services;

use App\Exceptions\DataNotFoundException;
use App\Exceptions\ExistDataException;
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

    /**
     * @param UserDto $dto
     * @throws DataNotFoundException
     * @throws ExistDataException
     */
    public function createUser(UserDto $dto)
    {
        if($this->isExistEmail($dto->getEmail())){
            throw new ExistDataException($dto->getEmail());
        }

        $catPatternTypeId = $this->getCatPatternType($dto->getCatPatternType());
        if (is_null($catPatternTypeId)) {
            throw new DataNotFoundException($dto->getCatPatternType());
        }

        $catTypeId = $this->getCatType($dto->getCatType());
        if (is_null($catTypeId)) {
            throw new DataNotFoundException($dto->getCatType());
        }

        $user = new User();
        $user->email = $dto->getEmail();
        $user->password = Hash::make($dto->getPassword());
        $user->age = $dto->getAge();
        $user->cat_pattern_type_id = $catPatternTypeId;
        $user->cat_type_id = $catTypeId;
        $user->save();
    }

    public function findUser(int $id)
    {
        return User::with(['catType', 'catPatternType'])->findOrFail($id);
    }

    private function getCatPatternType(string $catPatternType): ?int
    {
        return CatPatternType::whereType($catPatternType)->value('id');
    }

    private function getCatType(string $catType): ?int
    {
        return CatType::whereType($catType)->value('id');
    }

    private function isExistEmail(string $email): ?bool
    {
        return User::whereEmail($email)->exists();
    }
}
