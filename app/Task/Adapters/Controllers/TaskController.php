<?php

namespace App\Task\Adapters\Controllers;

use App\Abilities\Abilities;
use App\Shared\Controllers\BaseController;
use App\Task\Domain\Services\CreateTaskService;
use App\Task\Domain\Services\DeleteTaskService;
use App\Task\Domain\Services\FindByIdTaskService;
use App\Task\Domain\Services\ListTasksService;
use App\Task\Domain\Services\UpdateTaskService;
use App\Task\Http\Requests\StoreTaskRequest;
use App\Task\Http\Requests\UpdateTaskRequest;
use App\Task\Http\Resources\TaskResource;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 


class TaskController extends BaseController
{
    private CreateTaskService $createTaskService;
    private FindByIdTaskService $findTaskService;
    private ListTasksService $listTaskService;
    private DeleteTaskService $deleteTaskService;
    private UpdateTaskService $updateTaskService;

    public function __construct(
        DeleteTaskService $deleteTaskService,
        CreateTaskService $createTaskService,
        FindByIdTaskService $findTaskService,
        ListTasksService $listTaskService,
        UpdateTaskService $updateTaskService
        )
    {
        $this->createTaskService = $createTaskService;
        $this->findTaskService = $findTaskService;
        $this->listTaskService = $listTaskService;
        $this->deleteTaskService = $deleteTaskService;
        $this->updateTaskService = $updateTaskService;
    }

    public function index(Request $request){
        
        $perPage = $this->getPerPage($request);
        $tasks = $this->listTaskService->execute($perPage);

        return TaskResource::collection($tasks);
    }

    public function show($id)
    {
        $task = $this->findTaskService->execute($id);

        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $task){
        $Newtask = $this->createTaskService->execute($task->toArray());
        return new TaskResource($Newtask);
   }

    public function destroy($id){
          $response = $this->deleteTaskService->execute($id);
           return $response;
    }

    public function update(UpdateTaskRequest $task,$id){
        $response = $this->updateTaskService->execute($task->toArray(),$id);
        return new TaskResource($response);

  }
}


