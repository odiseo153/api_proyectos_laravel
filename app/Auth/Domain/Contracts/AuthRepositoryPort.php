<?php

namespace App\Auth\Domain\Contracts;

use App\Auth\Domain\Entities\User;

interface AuthRepositoryPort
{
    public function login(User $user): array |null;
    public function logout(): void;
    public function me(): array |null;
}
