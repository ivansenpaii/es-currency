<?php

namespace App\Service;

use App\Connector\CBRConnector;
use App\DTO\Response\CBR\RateDto;

class CurrencyService
{
    public function __construct(private readonly CBRConnector $CBRConnector)
    {
    }

    public function getCurrency(): RateDto
    {
        return $this->CBRConnector->getCurrency();
    }
}