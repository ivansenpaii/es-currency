<?php

namespace App\Connector\Helper;

use App\DTO\Response\CBR\CurrencyDto;
use App\DTO\Response\CBR\RateDto;
use Exception;
use Psr\Cache\InvalidArgumentException;
use SimpleXMLElement;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Contracts\Service\Attribute\Required;

class CBRHelper
{
    public const string CURRENCY_KEY = 'currencyFromCBR';
    public const int CURRENCY_EXPIRES_AFTER = 3600; // hour

    private AdapterInterface $cache;

    #[Required]
    public function setCache(AdapterInterface $cache)
    {
        $this->cache = $cache;
    }

    /** @throws Exception
     * @throws InvalidArgumentException
     */
    public function makeCurrencyDto(?SimpleXMLElement $xmlObject): RateDto
    {
        if (empty($xmlObject)) {
            throw new Exception('XML object is empty');
        }
        $this->setCurrencyToCache($xmlObject->asXML());

        $rate = new RateDto();
        $rate->date = (string) $xmlObject['Date'];
        $rate->name = (string) $xmlObject['name'];

        foreach ($xmlObject->Valute as $item) {
            $currency = new CurrencyDto();

            $currency->id = (string) $item['ID'];
            $currency->numCode = (int) $item->NumCode;
            $currency->charCode = (string) $item->CharCode;
            $currency->nominal = (int) $item->Nominal;
            $currency->name = (string) $item->Name;
            $currency->value = (float) str_replace(',', '.', $item->Value);
            $currency->unitRate = (float) str_replace(',', '.', $item->VunitRate);

            $rate->currency[] = $currency;
        }

        return $rate;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function findCurrencyFromCache(): ?SimpleXMLElement
    {
        $xml = $this->cache->getItem(self::CURRENCY_KEY);
        if (!$xml->isHit()) {
            return null;
        }
        return simplexml_load_string($xml->get()[self::CURRENCY_KEY]);
    }

    /**
     * @throws InvalidArgumentException
     */
    private function setCurrencyToCache(string $asXML): void
    {
        $xml = $this->cache->getItem(self::CURRENCY_KEY);
        $xml->set([self::CURRENCY_KEY => $asXML]);
        $this->cache->save($xml);
    }
}
