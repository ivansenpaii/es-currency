<?php

namespace App\Controller\Web;

use App\Form\CurrencyForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrencyFormController extends AbstractController
{
    public function __construct(private readonly CurrencyForm $currencyForm)
    {
    }

    #[Route('/', name: 'currency_convert')]
    public function convert(Request $request): Response
    {
        return $this->currencyForm->handleFormView($request);
    }
}
