<?php


namespace App\Exceptions;


use Exception;

class ExistDataException extends Exception
{
    public function __construct(string $data)
    {
        parent::__construct("This Data already exist : {$data}");
    }
}
