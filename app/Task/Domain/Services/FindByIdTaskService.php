<?php

namespace App\Task\Domain\Services;

use App\Task\Domain\Contracts\TaskRepositoryPort;

class FindByIdTaskService
{
    private TaskRepositoryPort $taskRepository;
    public function __construct(TaskRepositoryPort $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(string $id)
    {
        return $this->taskRepository->findById($id);
    }
}