<?php 
                
namespace App\Task;     
use App\Task\Adapters\Repositories\TaskRepository;
use App\Task\Domain\Contracts\TaskRepositoryPort;
use App\Policies\ProjectPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

            
    class TaskServiceProvider extends ServiceProvider
    {
        protected $policies = [
            Project::class => ProjectPolicy::class,
        ];

        public function register()
        {
        $this->app->bind(TaskRepositoryPort::class,TaskRepository::class);
                    
        }
                
        public function boot()
        {
           $this->registerPolicies();
        }
    }