<?php

namespace App\Exceptions;

use Exception;
class InvalidDataException extends Exception
{
    protected $message = 'Invalid Data';
}