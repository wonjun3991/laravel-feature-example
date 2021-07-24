<?php


namespace App\Exceptions;


use Exception;

class QuestionHasSelectedAnswerException extends Exception
{

    public function __construct()
    {
        parent::__construct("이미 채택된 답변이 존재합니다.");
    }
}
