<?php

namespace App\Task\Adapters\Repositories;

use App\Shared\Repositories\BaseRepository;
use App\Task\Domain\Contracts\TaskRepositoryPort;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Task as TaskModel;
use App\Task\Domain\Entities\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class TaskRepository extends BaseRepository implements TaskRepositoryPort
{
    use AuthorizesRequests;

    public function __construct()
    {
        parent::__construct(TaskModel::class); 
    }

    public function getAll(
        int $perPage,
        array $filters = [],
        array $sorts = [],
        string $defaultSort = '-updated_at',
        array $with = ['assigned']
    ): LengthAwarePaginator {
        // Extender filtros predeterminados
        $filters = array_merge($filters, ['name']);
    
        $user = Auth::user();
    
        // Usar la consulta base del padre para obtener las tareas
        $tasksQuery = parent::getAll($perPage, $filters, $sorts, $defaultSort, $with);
    
        // Ajustar la consulta según el rol del usuario
        if ($user->hasRole('miembro')) {
            $tasksQuery->whereIn('project_id', function ($query) use ($user) {
                $query->select('project_id')
                    ->from('project_user') // Suponiendo que esta es la tabla de relación entre proyectos y usuarios
                    ->where('user_id', $user->id);
            });
        }
    
        if ($user->hasRole('lider')) {
            $tasksQuery->whereIn('project_id', function ($query) use ($user) {
                $query->select('id')
                    ->from('projects')
                    ->where('leader_id', $user->id);
            });
        }
    
        // Paginación final
        return $tasksQuery;
    }
    

    public function create(Task $data): Task
    {
        $this->authorize('create', TaskModel::class); 


        $taskModel = TaskModel::create([
            'name' => $data->name,
            'description' => $data->description,
            'status' => $data->status ?? "En curso",
            'project_id' => $data->project_id,
            'assigned_to' => $data->assigned_to,
        ]);

        return new Task($taskModel->toArray());
    }

    public function findById($id): Task
    {
        $taskModel = TaskModel::with(['assigned', 'project'])->findOrFail($id);

       $this->authorize('view', $taskModel);


        return new Task($taskModel->toArray());
    }


    public function update(array $data,$id)
    {
        $taskModel = TaskModel::findOrFail($id);

        $this->authorize('update', $taskModel);

        $taskModel->update($data);

        return new Task($taskModel->toArray());
    }

    public function delete($id): bool
    {
        $taskModel = TaskModel::findOrFail($id);

        $this->authorize('delete', $taskModel);


        $taskModel->delete();

        return true;
    }
}