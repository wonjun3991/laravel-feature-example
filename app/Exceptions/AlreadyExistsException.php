<?php


namespace App\Exceptions;


use Exception;

class AlreadyExistsException extends Exception
{
    public function __construct(string $data)
    {
        parent::__construct("해당 데이터는 이미 존재하기 때문에 사용할 수 없습니다. : {$data}");
    }
}
