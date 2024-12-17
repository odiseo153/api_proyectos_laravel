<?php

namespace App\User\Domain\Services;

use App\User\Domain\Contracts\UserRepositoryPort;
use App\User\Domain\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateUserService
{
    private UserRepositoryPort $userRepository;

    public function __construct(UserRepositoryPort $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $password = Hash::make($data['password']);
            $data['password'] = $password;
            $user = new User($data);
            return $this->userRepository->create($user);
        });
    }
}
