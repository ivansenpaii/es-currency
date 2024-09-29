<?php

namespace App\Connector\Exceptions;

use Exception;

final class AuthDataNotFoundException extends Exception
{
    public function __construct(string $message = 'login or password not set')
    {
        parent::__construct($message);
    }
}
