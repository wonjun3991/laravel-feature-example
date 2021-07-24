<?php


namespace App\Services\Dto;


class QuestionDto
{
    private int $userId;
    private ?string $questionType;
    private ?string $title;
    private ?string $content;

    /**
     * QuestionDto constructor.
     * @param int|null $userId
     * @param string|null $questionType
     * @param string|null $title
     * @param string|null $content
     */
    public function __construct(
        int $userId,
        ?string $questionType = null,
        ?string $title = null,
        ?string $content = null
    )
    {
        $this->userId = $userId;
        $this->questionType = $questionType;
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @return string|null
     */
    public function getQuestionType(): ?string
    {
        return $this->questionType;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }
}
