<?php

namespace App\Services;

use App\Exceptions\HasAnswerException;
use App\Exceptions\QuestionHasSelectedAnswerException;
use App\Models\Question;
use App\Models\QuestionType;
use App\Services\Dto\QuestionDto;
use Gate;

class QuestionService
{
    const PAGINATE = 9;

    public function getQuestionList()
    {
        return Question::with(['questionType', 'user', 'user.catType', 'user.catPatternType'])->paginate(self::PAGINATE);
    }

    public function createQuestion(QuestionDto $dto)
    {
        $question = new Question();
        $question->user_id = $dto->getUserId();
        $question->question_type_id = $this->getQuestionTypeId($dto->getQuestionType());
        $question->title = $dto->getTitle();
        $question->content = $dto->getContent();
        $question->save();
    }

    public function updateQuestion(int $id, QuestionDto $dto)
    {
        $question = Question::findOrFail($id);
        Gate::authorize('update', $question);
        if ($question->hasAnswer()) {
            throw new HasAnswerException();
        }
        if ($question->hasSelectedAnswer()) {
            throw new QuestionHasSelectedAnswerException();
        }
        if (is_null($dto->getQuestionType())) {
            $question->question_type_id = $this->getQuestionTypeId($dto->getQuestionType());
        }
        if (is_null($dto->getTitle())) {
            $question->title = $dto->getTitle();
        }
        if (is_null($dto->getContent())) {
            $question->content = $dto->getContent();
        }
        $question->save();
    }

    public function findQuestion(int $id)
    {
        return Question::with(['questionType', 'user', 'user.catType', 'user.catPatternType'])->findOrFail($id);
    }

    public function deleteQuestion(int $id)
    {
        $question = Question::findOrFail($id);
        if ($question->hasAnswer()) {
            throw new HasAnswerException();
        }
        $question->delete();
    }

    private function getQuestionTypeId(string $questionType): int
    {
        return QuestionType::whereType($questionType)->firstOrFail()->id;
    }
}
