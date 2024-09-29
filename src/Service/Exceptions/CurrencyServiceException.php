<?php

namespace App\Service\Exceptions;

use Exception;

final class CurrencyServiceException extends Exception
{
    public function __construct(string $message = 'currency service error')
    {
        parent::__construct($message);
    }
}
