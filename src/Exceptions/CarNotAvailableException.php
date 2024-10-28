<?php

namespace App\Exceptions;

use Exception;

class CarNotAvailableException extends Exception
{
    protected $message = 'Car not available';
}