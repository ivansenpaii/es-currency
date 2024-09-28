<?php

namespace App\Connector\Exceptions;

use Exception;

final class UrlEmptyException extends Exception
{
    public function __construct(string $message = 'URL does not set')
    {
        parent::__construct($message);
    }
}
