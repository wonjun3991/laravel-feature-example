<?php


namespace App\Exceptions;


use Exception;

class HasAnswerException extends Exception
{
    public function __construct()
    {
        parent::__construct("해당 질문에 답변이 존재하여 수정하거나 삭제 할 수 없습니다.");
    }
}
