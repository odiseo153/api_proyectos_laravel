<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear un usuario admin fijo
        User::factory()->create([
            'name' => 'Test User',
            'username' => 'test',
            'email' => 'test@example.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Test Lider',
            'username' => 'test.lider',
            'email' => 'lider@example.com',
            'role' => 'lider',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Test Miembro',
            'username' => 'test.miembro',
            'email' => 'miembro@example.com',
            'role' => 'miembro',
            'password' => bcrypt('password'),
        ]);

        // Crear usuarios adicionales
        $users = User::factory(10)->create();

        // Filtrar usuarios por roles
        $leaders = $users->where('role', 'lider');
        $admins = $users->where('role', 'admin');
        $members = $users->where('role', 'miembro');

        // Crear proyectos y asignar miembros
        $projects = Project::factory(10)->create(function () use ($leaders, $admins) {
            return [
                'leader_id' => $leaders->random()?->id, // Seleccionar un líder aleatorio
                'create_by' => $admins->random()?->id,  // Seleccionar un admin aleatorio
            ];
        });

        // Asignar miembros a proyectos
        foreach ($projects as $project) {
            // Asegúrate de no pedir más miembros de los disponibles
            $projectMembers = $members->random(min(rand(2, 5), $members->count()));
        
            // Asignar miembros al proyecto
            $project->members()->attach($projectMembers);
        }
        

        // Crear tareas dentro de los proyectos
        foreach ($projects as $project) {
            // Seleccionar solo miembros del proyecto
            $projectMembers = $project->members;

            Task::factory(5)->create(function () use ($project, $projectMembers) {
                return [
                    'project_id' => $project->id,
                    'assigned_to' => $projectMembers->random()?->id, // Asignar tarea a un miembro del proyecto
                ];
            });
        }
    }
}
