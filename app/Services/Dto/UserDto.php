<?php


namespace App\Services\Dto;


class UserDto
{
    private string $email;
    private string $password;
    private string $type;
    private string $catType;
    private string $catPatternType;
    private int $age;

    /**
     * UserDto constructor.
     * @param string $email
     * @param string $password
     * @param string $type
     * @param string $catType
     * @param string $catPatternType
     * @param int $age
     */
    public function __construct(
        string $email,
        string $password,
        string $type,
        string $catType,
        string $catPatternType,
        int $age
    )
    {
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;
        $this->catType = $catType;
        $this->catPatternType = $catPatternType;
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getCatType(): string
    {
        return $this->catType;
    }

    /**
     * @return string
     */
    public function getCatPatternType(): string
    {
        return $this->catPatternType;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }
}
