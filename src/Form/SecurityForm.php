<?php

namespace App\Form;

use App\Security\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityForm extends AbstractController
{
    public function __construct(
        private readonly AuthenticationUtils $authenticationUtils,
        private readonly Security $securityService,
    ) {
    }

    private function createLoginFormView(): FormInterface
    {
        return $this->createFormBuilder()
            ->add('_username', TextType::class, [
                'label' => 'Логин',
                'attr' => ['class' => 'form-control', 'required' => true],
            ])
            ->add('_password', PasswordType::class, [
                'label' => 'Пароль',
                'attr' => ['class' => 'form-control', 'required' => true],
            ])
            ->getForm();
    }

    public function handleFormView(Request $request): Response
    {
        $form = $this->createLoginFormView();

        $form->handleRequest($request);
        $error = $this->authenticationUtils->getLastAuthenticationError();

        if (Request::METHOD_POST === $request->getMethod() && $this->securityService->isValidUser($form->getData())) {
            return $this->redirectToRoute('currency_convert');
        }

        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }
}
