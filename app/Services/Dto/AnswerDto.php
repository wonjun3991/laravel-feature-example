<?php


namespace App\Services\Dto;


class AnswerDto
{
    private int $userId;
    private ?bool $selected;
    private ?string $content;

    /**
     * AnswerDto constructor.
     * @param int $userId
     * @param bool|null $selected
     * @param string|null $content
     */
    public function __construct(
        int $userId,
        ?bool $selected = null,
        ?string $content = null
    )
    {
        $this->userId = $userId;
        $this->selected = $selected;
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return bool|null
     */
    public function getSelected(): ?bool
    {
        return $this->selected;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }
}
