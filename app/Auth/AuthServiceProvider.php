<?php

namespace App\Auth;

use App\Auth\Adapters\Repositories\AuthRepository;
use App\Auth\Domain\Contracts\AuthRepositoryPort;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        \App\Models\Project::class => \App\Policies\ProjectPolicy::class,
        \App\Models\Task::class => \App\Policies\TaskPolicy::class,
    ];

 
    
    public function register()
    {
        $this->app->bind(AuthRepositoryPort::class, AuthRepository::class);
    }

    public function boot() {}
}
