<?php


namespace App\Exceptions;


use Exception;

class DataNotFoundException extends Exception
{
    public function __construct(string $data)
    {
        parent::__construct("Data Notfound : {$data}");
    }
}
