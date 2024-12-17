<?php

namespace App\Auth\Domain\Services;

use App\Auth\Domain\Contracts\AuthRepositoryPort;

class LogoutService
{
    private AuthRepositoryPort $authRepository;

    public function __construct(AuthRepositoryPort $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function execute(): void
    {
        $this->authRepository->logout();
    }
}
