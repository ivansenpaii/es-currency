<?php

namespace App\Controller\Security;

use App\Form\SecurityForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SecurityController extends AbstractController
{
    public function __construct(private readonly SecurityForm $securityForm)
    {
    }

    #[Route('/login', name: 'app_login')]
    public function login(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('currency_convert');
        }

        return $this->securityForm->handleFormView($request);
    }
}
