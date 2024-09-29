<?php

namespace App\Controller\v1;

use App\Service\CurrencyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CurrencyController extends AbstractController
{
    public function __construct(private readonly CurrencyService $currencyService)
    {
    }

    #[Route(path: '/currency', name: 'get_currency', methods: [Request::METHOD_GET])]
    public function getCurrency(): JsonResponse
    {
        return new JsonResponse($this->currencyService->getCurrency());
    }
}
