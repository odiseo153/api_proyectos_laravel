<?php

namespace App\Task\Domain\Services;

use App\Task\Domain\Contracts\TaskRepositoryPort;

class ListTasksService
{
    private TaskRepositoryPort $taskRepository;
    public function __construct(TaskRepositoryPort $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(int $perPage)
    {
        return $this->taskRepository->getAll($perPage);
    }
} 