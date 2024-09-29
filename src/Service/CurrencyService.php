<?php

namespace App\Service;

use App\Connector\CBRConnector;
use App\Service\Exceptions\CurrencyServiceException;
use App\DTO\Response\CBR\CurrencyDto;
use App\DTO\Response\CBR\RateDto;

readonly class CurrencyService
{
    public function __construct(private CBRConnector $CBRConnector)
    {
    }

    public function getCurrency(): RateDto
    {
        return $this->CBRConnector->getCurrency();
    }

    public function getAvailableChoiceAsArray(): array
    {
        $listChoice = [];
        /** @var CurrencyDto $currency */
        foreach ($this->getCurrency()->currency as $currency) {
            $listChoice += [$currency->id => $currency->name];
        }
        return $listChoice;
    }

    /**
     * @throws CurrencyServiceException
     */
    public function calculateCurrencyResult(float $amount, string $fromId, string $toId): float
    {
        return $amount * ($this->valueById($fromId) / $this->valueById($toId));
    }

    /**
     * @throws CurrencyServiceException
     */
    public function valueById(string $id): float
    {
        foreach ($this->getCurrency()->currency as $currency) {
            if ($id === $currency->id) {
                return $currency->unitRate;
            }
        }
        throw new CurrencyServiceException('currency not found');
    }
}
