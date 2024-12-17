<?php

namespace App\Task\Domain\Services;

use App\Task\Domain\Contracts\TaskRepositoryPort;
use App\Task\Domain\Entities\Task;

class UpdateTaskService
{
    private TaskRepositoryPort $taskRepository;
    public function __construct(TaskRepositoryPort $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(array $data,$id)
    {
        return $this->taskRepository->update($data,$id);
    }
}