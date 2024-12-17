<?php

namespace App\Project\Adapters\Controllers;

use App\Project\Domain\Services\CreateProjectService;
use App\Project\Domain\Services\DeleteProjectService;
use App\Project\Domain\Services\FindByIdProjectService;
use App\Project\Domain\Services\ListMembersProjectsService;
use App\Project\Domain\Services\ListProjectsService;
use App\Project\Domain\Services\ToggleProjectService;
use App\Project\Domain\Services\UpdateProjectService;
use App\Project\Http\Requests\StoreProjectRequest;
use App\Project\Http\Requests\UpdateProjectRequest;
use App\Project\Http\Resources\ProjectResource;
use App\Shared\Controllers\BaseController;
use Illuminate\Http\Request;

class ProjectController extends BaseController
{

     
    private CreateProjectService $createProjectService;
    private FindByIdProjectService $findByIdProjectService;
    private ListProjectsService $listProjectsService;
    private DeleteProjectService $deleteProjectsService;
    private UpdateProjectService $updateProjectsService;
    private ToggleProjectService $toggleProjectsService;


    public function __construct(ToggleProjectService $toggleProjectsService,UpdateProjectService $updateProjectsService, DeleteProjectService $deleteProjectsService, CreateProjectService $createProjectService, FindByIdProjectService $findByIdProjectService, ListProjectsService $listProjectsService)
    {
        // Constructor logic here
        $this->createProjectService = $createProjectService;
        $this->findByIdProjectService = $findByIdProjectService;
        $this->listProjectsService = $listProjectsService;
        $this->deleteProjectsService = $deleteProjectsService;
        $this->updateProjectsService = $updateProjectsService;
        $this->toggleProjectsService = $toggleProjectsService;
    }

    public function index(Request $request)
    {

        $perPage = $this->getPerPage($request);
        $projects = $this->listProjectsService->execute($perPage);

        return ProjectResource::collection($projects);
    }


    public function store(StoreProjectRequest $project)
    {
        
        $newProject = $this->createProjectService->execute($project->toArray());
        return new ProjectResource($newProject);
    }

    public function update(UpdateProjectRequest $project, $id)
    {
        $newProject = $this->updateProjectsService->execute($project->toArray(), $id);
        return new ProjectResource($newProject);

    }

    public function show($id)
    {
        $project = $this->findByIdProjectService->execute($id);
        return new ProjectResource($project);
    }

  
    public function toggle($id)
    {
        $project = $this->toggleProjectsService->execute($id);
        return new ProjectResource($project);
    }


    public function destroy($id)
    {
        $project = $this->deleteProjectsService->execute($id);
        return $project;

    }
}




