<?php


namespace App\Services;


use App\Exceptions\AlreadyExistsException;
use App\Models\CatPatternType;
use App\Models\CatType;
use App\Models\User;
use App\Services\Dto\UserDto;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(string $email, string $password): bool
    {
        return auth()->attempt(['email' => $email, 'password' => $password]);
    }

    public function register(UserDto $dto)
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

    public function logout()
    {
        auth()->user()->tokens()->delete();
    }

    public function getToken(string $email)
    {
        $user = User::whereEmail($email)->with(['catType', 'catPatternType'])->first();
        $token = $user->createToken('auth-token')->plainTextToken;
        return $token;
    }

    public function getProfile()
    {
        return auth()->user();
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
