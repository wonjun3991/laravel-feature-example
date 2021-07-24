<?php


namespace App\Exceptions;


use Exception;

class AlreadyExistsException extends Exception
{
    public function __construct(string $data)
    {
        parent::__construct("This Data already exist : {$data}");
    }
}
