<?php

namespace App\Task\Domain\Services;

use App\Task\Domain\Contracts\TaskRepositoryPort;
use App\Task\Domain\Entities\Task;

class CreateTaskService
{
    private TaskRepositoryPort $taskRepository;
    public function __construct(TaskRepositoryPort $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(array $data)
    {
        $task = new Task($data);
        return $this->taskRepository->create($task);
    }
}