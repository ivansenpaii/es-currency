<?php

namespace App\Tests\Unit\Service;

use App\Connector\CBRConnector;
use App\DTO\Response\CBR\CurrencyDto;
use App\DTO\Response\CBR\RateDto;
use App\Service\CurrencyService;
use App\Service\Exceptions\CurrencyServiceException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

#[CoversClass(CurrencyService::class)]
class CurrencyServiceTest extends TestCase
{
    private CurrencyService $currencyService;
    private MockObject|CBRConnector $CBRConnectorMock;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->CBRConnectorMock = $this->createMock(CBRConnector::class);
        $this->currencyService = new CurrencyService($this->CBRConnectorMock);
    }

    /**
     * @throws Exception
     */
    public function testGetCurrency(): void
    {
        $rateDtoMock = $this->createMock(RateDto::class);
        $this->CBRConnectorMock->expects($this->once())->method('getCurrency')->willReturn($rateDtoMock);

        $result = $this->currencyService->getCurrency();

        $this->assertInstanceOf(RateDto::class, $result);
        $this->assertEquals($rateDtoMock, $result);
    }

    /**
     * @throws Exception
     */
    public function testGetAvailableChoiceAsArray(): void
    {
        $currencyDto = new CurrencyDto();
        $currencyDto->id = 'mockId';
        $currencyDto->name = 'mockName';

        $rateDto = new RateDto();
        $rateDto->currency = [$currencyDto, $currencyDto];

        $this->CBRConnectorMock->expects($this->once())->method('getCurrency')->willReturn($rateDto);

        $result = $this->currencyService->getAvailableChoiceAsArray();

        $this->assertIsArray($result);
        $this->assertArrayHasKey($currencyDto->id, $result);
        $this->assertEquals($currencyDto->name, $result[$currencyDto->id]);
    }

    /**
     * @throws CurrencyServiceException
     */
    public function testCalculateCurrencyResult(): void
    {
        $fromCurrencyDto = new CurrencyDto();
        $fromCurrencyDto->id = 'id1';
        $fromCurrencyDto->unitRate = 1;

        $toCurrencyDto = new CurrencyDto();
        $toCurrencyDto->id = 'id2';
        $toCurrencyDto->unitRate = 0.5;

        $rateDto = new RateDto();
        $rateDto->currency = [$fromCurrencyDto, $toCurrencyDto];

        $this->CBRConnectorMock->expects($this->any())->method('getCurrency')->willReturn($rateDto);

        $result = $this->currencyService->calculateCurrencyResult(100, 'id1', 'id2');

        $this->assertEquals(200, $result);
        $this->assertIsFloat($result);
    }

    /**
     * @throws CurrencyServiceException
     */
    public function testValueById(): void
    {
        $currencyDto = new CurrencyDto();
        $currencyDto->id = 'id1';
        $currencyDto->unitRate = 1;

        $rateDto = new RateDto();
        $rateDto->currency = [$currencyDto];

        $this->CBRConnectorMock->expects($this->once())->method('getCurrency')->willReturn($rateDto);
        $result = $this->currencyService->valueById('id1');

        $this->assertIsFloat($result);
        $this->assertEquals($currencyDto->unitRate, $result);
    }

    #[DoesNotPerformAssertions]
    public function testValueByIdThrowsException(): void
    {
        $rateDto = new RateDto();
        $this->CBRConnectorMock->expects($this->once())->method('getCurrency')->willReturn($rateDto);

        $this->expectException(CurrencyServiceException::class);
        $this->currencyService->valueById('UNKNOWN');
    }
}