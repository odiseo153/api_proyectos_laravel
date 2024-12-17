<?php

namespace App\User;

use Illuminate\Support\ServiceProvider;
use App\User\Domain\Contracts\UserRepositoryPort;
use App\User\Adapters\Repositories\UserRepository;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryPort::class, UserRepository::class);
    }

    public function boot() {}
}
