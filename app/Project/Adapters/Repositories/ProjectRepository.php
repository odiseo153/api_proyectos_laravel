<?php

namespace App\Project\Adapters\Repositories;

use App\Project\Domain\Contracts\ProjectRepositoryPort;
use App\Models\Project as ProjectModel;
use App\Project\Domain\Entities\Project;
use App\Shared\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectRepository extends BaseRepository implements ProjectRepositoryPort
{
    use AuthorizesRequests;

    public function __construct()
    {
        parent::__construct(ProjectModel::class);
    }

    public function getAll(int $perPage, array $filters = [], array $sorts = [], string $defaultSort = '-updated_at', array $with = ['createBy', 'leader']): LengthAwarePaginator
    {
        $filters = array_merge($filters, ['name']);
        return parent::getAll($perPage, $filters, $sorts, $defaultSort, $with);
    }

    public function create(Project $data)
    {
        $this->authorize('create', Project::class);
       
        $project = ProjectModel::create([
            'name' => $data->name,
            'description' => $data->description,
            'status' => $data->status ?? "En progreso",
            'leader_id' => $data->leader_id,
            'create_by' => Auth::id()
        ]);

        return new Project($project->toArray());
    }

    public function update(array $data, $id)
    {
        $project = ProjectModel::findOrFail($id);

        $this->authorize('update',$project);

        $project->update($data);
        return new Project($project->toArray());
    }


    public function findById($id)
    {
        $project = ProjectModel::with(['createBy','leader','members'])->findOrFail($id);
        return new Project($project->toArray());
    }

    public function toggle_group($id)
    {
       $project = ProjectModel::findOrFail($id);

       $project->members()->toggle(Auth::id());

       return $project;
    }

    public function delete($id): bool
    {
            $project = ProjectModel::findOrFail($id);
            $this->authorize('delete',$project);

            $project->delete();
            return true;
    }
}