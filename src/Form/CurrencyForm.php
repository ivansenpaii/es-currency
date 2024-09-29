<?php

namespace App\Form;

use App\Service\CurrencyService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CurrencyForm extends AbstractController
{
    public const float CURRENCY_ERROR = -1;

    public function __construct(private readonly CurrencyService $currencyService)
    {
    }

    private function createFormView(array $rates): FormInterface
    {
        return $this->createFormBuilder()
            ->add('from', ChoiceType::class, [
                'choices' => $rates,
                'label' => 'Из валюты',
            ])
            ->add('to', ChoiceType::class, [
                'choices' => $rates,
                'label' => 'В валюту',
            ])
            ->add('amount', NumberType::class, [
                'label' => 'Сумма',
            ])
            ->getForm();
    }

    public function handleFormView(Request $request): Response
    {
        $rates = $this->currencyService->getAvailableChoiceAsArray();

        $form = $this->createFormView(array_flip($rates));

        $form->handleRequest($request);
        return $this->render('currency/convert.html.twig', [
            'form' => $form->createView(),
            'result' => $this->calculateCurrencyResult($form),
        ]);
    }

    private function calculateCurrencyResult(FormInterface $form): ?float
    {
        $data = $form->getData();
        try {
            return $form->isSubmitted() && $form->isValid()
                ? $this->currencyService->calculateCurrencyResult($data['amount'], $data['from'], $data['to'])
                : self::CURRENCY_ERROR;
        } catch (Exception) {
            return self::CURRENCY_ERROR;
        }

    }
}
