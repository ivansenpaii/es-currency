<?php

namespace App\Config\Exceptions;

use Exception;

final class ClientConfigurationNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('config for http-client not found');
    }
}
