<?php

namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

readonly class Security
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $hasher,
        private TokenStorageInterface $tokenStorage,
    ) {
    }

    public function isValidUser(array $formData): bool
    {
        $password = $formData['_password'];

        $user = $this->userRepository->findOneByUsername($formData['_username']);
        if (empty($user)) {
            return false;
        }
        if ($this->hasher->isPasswordValid($user, $password)) {
            $token = new UsernamePasswordToken($user, $password, $user->getRoles());
            $this->tokenStorage->setToken($token);
            return true;
        }
        return false;
    }
}
