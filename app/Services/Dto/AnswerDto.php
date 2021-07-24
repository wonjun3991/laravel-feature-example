<?php


namespace App\Services\Dto;


class AnswerDto
{
    private ?int $questionId;
    private int $userId;
    private ?bool $selected;
    private ?string $content;

    /**
     * AnswerDto constructor.
     * @param int|null $questionId
     * @param int $userId
     * @param bool|null $selected
     * @param string|null $content
     */
    public function __construct(
        ?int $questionId = null,
        int $userId,
        ?bool $selected = null,
        ?string $content = null
    )
    {
        $this->questionId = $questionId;
        $this->userId = $userId;
        $this->selected = $selected;
        $this->content = $content;
    }

    /**
     * @return int|null
     */
    public function getQuestionId(): ?int
    {
        return $this->questionId;
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
