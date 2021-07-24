<?php


namespace App\Exceptions;


use Exception;

class IsSelectedAnswerException extends Exception
{

    public function __construct()
    {
        parent::__construct("이미 채택된 답변은 수정하거나 삭제할 수 없습니다.");
    }
}
