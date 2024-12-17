<?php

namespace App\Auth\Domain\Services;

use App\Auth\Domain\Contracts\AuthRepositoryPort;
use App\Auth\Domain\Entities\User;

class LoginService
{
    private AuthRepositoryPort $authRepository;

    public function __construct(AuthRepositoryPort $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function execute(string $username, string $password): array
    {
        $user = new User($username, $password);
        return $this->authRepository->login($user);
    }
}
