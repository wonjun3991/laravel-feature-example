<?php


namespace App\Services;


use App\Exceptions\IsSelectedAnswerException;
use App\Exceptions\QuestionHasAnswersMoreThanLimitException;
use App\Models\Answer;
use App\Models\Question;
use App\Services\Dto\AnswerDto;
use Gate;

class AnswerService
{
    public function getAnswerList(int $questionId)
    {
        return Question::with(['answers','answers.user'])
            ->findOrFail($questionId)
            ->answers;
    }

    public function createAnswer(int $questionId, AnswerDto $answerDto): int
    {
        Gate::authorize('create', Answer::class);
        if (Question::findOrFail($questionId)->hasAnswerMoreThanLimit()) {
            throw new QuestionHasAnswersMoreThanLimitException();
        }

        $answer = new Answer();
        $answer->question_id = $questionId;
        $answer->user_id = $answerDto->getUserId();
        $answer->content = $answerDto->getContent();
        $answer->saveOrFail();
        return $answer->id;
    }

    public function updateAnswer(int $answerId, AnswerDto $answerDto)
    {
        $answer = Answer::with(['question', 'question.user'])->findOrFail($answerId);
        if ($answer->isSelected()) {
            throw new IsSelectedAnswerException();
        }

        if ($answer->question->user->id === $answerDto->getUserId()) {
            if (!is_null($answerDto->getSelected())) {
                $answer->selected = $answerDto->getSelected();
            }
        }

        if (Gate::allows('update', $answer)) {
            if (!is_null($answerDto->getContent())) {
                $answer->content = $answerDto->getContent();
            }
        }
        $answer->saveOrFail();
    }

    public function findAnswer(int $answerId)
    {
        return Answer::with(['user'])->findOrFail($answerId);
    }

    public function selectAnswer(int $answerId)
    {
        $answer = Answer::findOrFail($answerId);
        $answer->selected = true;
        $answer->save();
    }

    public function deleteAnswer(int $answerId)
    {
        $answer = Answer::findOrFail($answerId);
        Gate::authorize('delete', $answer);
        if ($answer->isSelected()) {
            throw new IsSelectedAnswerException();
        }
        $answer->delete();
    }
}
