<?php 
                
namespace App\Project;     
use App\Project\Adapters\Repositories\ProjectRepository;
use App\Project\Domain\Contracts\ProjectRepositoryPort;
use Illuminate\Support\ServiceProvider;
            
    class ProjectServiceProvider extends ServiceProvider
    {
        
        public function register()
        {
        $this->app->bind(ProjectRepositoryPort::class,ProjectRepository::class);
        
        }
                
        public function boot()
        {
        // Perform actions during the booting process
        }
    }