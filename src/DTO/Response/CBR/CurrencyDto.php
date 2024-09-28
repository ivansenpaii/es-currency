<?php

namespace App\DTO\Response\CBR;

class CurrencyDto
{
    public string $id;
    public int $numCode;
    public string $charCode;
    public int $nominal;
    public string $name;
    public float $value;
    public float $unitRate;
}
