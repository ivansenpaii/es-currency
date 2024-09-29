<?php

namespace App\DTO\Response\CBR;

class RateDto
{
    public string $date;

    public string $name;

    /** @var CurrencyDto[] */
    public array $currency = [];
}
