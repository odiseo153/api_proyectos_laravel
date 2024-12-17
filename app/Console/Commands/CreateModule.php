<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateModule extends Command
{
    protected $signature = 'make:module {PascalCaseName}';
    protected $description = 'Creates a new module with its files and subdirectories.';

    public function handle()
    {
        $moduleName = $this->argument('PascalCaseName');

        $directories = $this->getModuleDirectories($moduleName);
        $this->createDirectories($directories);

        $this->createModuleClassesAndInterfaces($moduleName);

        $this->info("Module $moduleName created successfully.");
    }

    private function getModuleDirectories(string $moduleName) : array
    {
        $directories = [
            app_path("$moduleName/Adapters/Controllers"),
            app_path("$moduleName/Adapters/Repositories"),
            app_path("$moduleName/Domain/Contracts"),
            app_path("$moduleName/Domain/Entities"),
            app_path("$moduleName/Domain/Services"),
            app_path("$moduleName/Http/Requests"),
            app_path("$moduleName/Http/Resources"),
            app_path("$moduleName")
        ];

        return $directories;
    }

    private function createDirectories(array $directories): void
    {
        foreach ($directories as $directory) {
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
                $this->info("Created directory: $directory");
            } else {
                $this->comment("Directory already exists: $directory");
            }
        }
    }

    private function createModuleClassesAndInterfaces(string $moduleName): void
    {
        $files = [
            // Controlador (Generado por Artisan, contenido predeterminado)
            [
                'type' => 'controller',
                'path' => "$moduleName/Adapters/Controllers/{$moduleName}Controller.php",
                'content' => "<?php\n\nnamespace App\\$moduleName\\Adapters\\Controllers;\n\nuse App\\Http\\Controllers\\Controller;\n\nclass {$moduleName}Controller extends Controller\n{\n    public function __construct()\n    {\n        // Constructor logic here\n    }\n}"
            ],
            // Repositorio (Generado por Artisan, contenido predeterminado)
            [
                'type' => 'repository',
                'path' => "$moduleName/Adapters/Repositories/{$moduleName}Repository.php",
                'content' => "<?php\n\nnamespace App\\$moduleName\\Adapters\\Repositories;\n\nuse App\\$moduleName\\Domain\\Contracts\\{$moduleName}RepositoryPort;\n\nclass {$moduleName}Repository implements {$moduleName}RepositoryPort\n{\n    public function __construct()\n    {\n        // Constructor logic here\n    }\n\n    public function create(array \$data)\n    {\n        // Your create logic here\n    }\n\n    public function getAll()\n    {\n        // Your logic to get all records\n    }\n\n    public function findById(\$id)\n    {\n        // Your logic to find record by ID\n    }\n}"
            ],
            // Interfaz del repositorio (Contract) (Interfaz manual con un constructor)
            [
                'type' => 'repositoryInterface',
                'path' => "$moduleName/Domain/Contracts/{$moduleName}RepositoryPort.php",
                'content' => "<?php\n\nnamespace App\\$moduleName\\Domain\\Contracts;\n\ninterface {$moduleName}RepositoryPort\n{\n    public function create(array \$data);\n    public function getAll();\n    public function findById(\$id);\n}"
            ],
            // Entidad (Clase básica con constructor)
            [
                'type' => 'entity',
                'path' => "$moduleName/Domain/Entities/{$moduleName}.php",
                'content' => "<?php\n\nnamespace App\\$moduleName\\Domain\\Entities;\n\nclass {$moduleName}\n{\n    public \$id;\n\n    public function __construct(\$id = null)\n    {\n        \$this->id = \$id;\n    }\n}"
            ],
            // Servicios (Métodos de servicio básicos con constructor)
            [
                'type' => 'service',
                'path' => "$moduleName/Domain/Services/Create{$moduleName}Service.php",
                'content' => "<?php\n\nnamespace App\\$moduleName\\Domain\\Services;\n\nclass Create{$moduleName}Service\n{\n    public function __construct()\n    {\n        // Constructor logic here\n    }\n\n    public function execute(array \$data)\n    {\n        // Service execution logic\n    }\n}"
            ],
            [
                'type' => 'service',
                'path' => "$moduleName/Domain/Services/List{$moduleName}sService.php",
                'content' => "<?php\n\nnamespace App\\$moduleName\\Domain\\Services;\n\nclass List{$moduleName}sService\n{\n    public function __construct()\n    {\n        // Constructor logic here\n    }\n\n    public function execute()\n    {\n        // Service logic to list all {$moduleName}s\n    }\n}"
            ],
            [
                'type' => 'service',
                'path' => "$moduleName/Domain/Services/FindById{$moduleName}Service.php",
                'content' => "<?php\n\nnamespace App\\$moduleName\\Domain\\Services;\n\nclass FindById{$moduleName}Service\n{\n    public function __construct()\n    {\n        // Constructor logic here\n    }\n\n    public function execute(\$id)\n    {\n        // Service logic to find {$moduleName} by ID\n    }\n}"
            ],
            // Request (Generado por Artisan, contenido predeterminado)
            [
                'type' => 'request',
                'path' => "$moduleName/Http/Requests/Store{$moduleName}Request.php",
                'content' => "<?php\n\nnamespace App\\$moduleName\\Http\\Requests;\n\nuse Illuminate\\Foundation\\Http\\FormRequest;\n\nclass Store{$moduleName}Request extends FormRequest\n{\n    public function rules()\n    {\n        return [\n            // Define your validation rules here\n        ];\n    }\n}"
            ],
            // Resource (Generado por Artisan, contenido predeterminado)
            [
                'type' => 'resource',
                'path' => "$moduleName/Http/Resources/{$moduleName}Resource.php",
                'content' => "<?php\n\nnamespace App\\$moduleName\\Http\\Resources;\n\nuse Illuminate\\Http\\Resources\\Json\\JsonResource;\n\nclass {$moduleName}Resource extends JsonResource\n{\n    public function toArray(\$request)\n    {\n        return [\n            // Transform the resource\n        ];\n    }\n}"
            ],
            // ServiceProvider (Clase básica con constructor)
            [
                'type' => 'serviceProvider',
                'path' => "$moduleName/{$moduleName}ServiceProvider.php",
                'content' => "<?php 
                
namespace App\\$moduleName;     
use App\\$moduleName\\Adapters\\Repositories\\{$moduleName}Repository;
use App\\$moduleName\\Domain\\Contracts\\{$moduleName}RepositoryPort;
use Illuminate\\Support\\ServiceProvider;
            
    class {$moduleName}ServiceProvider extends ServiceProvider
    {
        public function register()
        {
        \$this->app->bind({$moduleName}RepositoryPort::class,{$moduleName}Repository::class);
                    
        }
                
        public function boot()
        {
        // Perform actions during the booting process
        }
    }"
            ]
            
        ];

        foreach ($files as $file) {
            $this->createFile(app_path($file['path']), $file['content'], $file['type']);
        }
    }

    private function createFile(string $filePath, string $content): void
    {
        if (!File::exists($filePath)) {
            file_put_contents($filePath, $content);
            $this->info("Created file: $filePath");
        } else {
            $this->comment("File already exists: $filePath");
        }
    }
}
