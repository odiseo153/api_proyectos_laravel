<?php

namespace App\User\Domain\Contracts;

use App\User\Domain\Entities\User;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryPort
{
    public function create(User $user): User;
    public function getAll(int $perPage): LengthAwarePaginator;
    public function findById(string $id): User;
    public function projects();
    public function tasks();
    public function update(string $id, array $data): User;
}
