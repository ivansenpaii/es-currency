<?php

namespace App\Connector;

use App\Config\Exceptions\ClientConfigurationNotFoundException;
use App\Connector\Helper\CBRHelper;
use App\DTO\Response\CBR\RateDto;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Throwable;

class CBRConnector extends AbstractConnector
{
    #[Required]
    public CBRHelper $helper;

    public function getConfigName(): string
    {
        return 'cbr_connector';
    }

    /** @throws ClientConfigurationNotFoundException */
    private function getEndpoints(): array
    {
        return $this->customConfig->getConfig($this->getConfigName())['endpoints'];
    }

    /** @throws ClientConfigurationNotFoundException */
    private function getScriptEndpoint(): string
    {
        return $this->getEndpoints()['script'];
    }

    public function getCurrency(): RateDto
    {
        try {
            $xmlObject = $this->helper->findCurrencyFromCache();
            if (empty($xmlObject)) {
                $xmlObject = $this->sendToXml(Request::METHOD_GET, "{$this->getScriptEndpoint()}/XML_daily.asp");
            }

            return $this->helper->makeCurrencyDto($xmlObject);
        } catch (Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
