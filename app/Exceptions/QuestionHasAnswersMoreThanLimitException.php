<?php


namespace App\Exceptions;


use App\Models\Question;

class QuestionHasAnswersMoreThanLimitException extends \Exception
{
    public function __construct()
    {
        $maxAnswersCount = Question::MAX_ANSWERS_LIMIT;

        parent::__construct("질문은 {$maxAnswersCount} 개를 초과하는 답변을 가지지 못합니다.");
    }
}
