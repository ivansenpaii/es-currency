<?php

namespace App\Connector\Exceptions;

use Exception;

final class AuthTypeEmptyException extends Exception
{
    public function __construct(string $message = 'auth_type empty')
    {
        parent::__construct($message);
    }
}
