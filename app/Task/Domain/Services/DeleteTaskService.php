<?php

namespace App\Task\Domain\Services;

use App\Task\Domain\Contracts\TaskRepositoryPort;

class DeleteTaskService
{
    private TaskRepositoryPort $taskRepository;
    public function __construct(TaskRepositoryPort $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute($id)
    {
        return $this->taskRepository->delete($id);
    }
}




