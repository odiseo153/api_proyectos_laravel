<?php

namespace App\Project\Domain\Services;

use App\Project\Domain\Contracts\ProjectRepositoryPort;

class ListProjectsService
{
    private ProjectRepositoryPort $projectRepository;
    public function __construct(ProjectRepositoryPort $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function execute(int $perPage)
    {
       return $this->projectRepository->getAll($perPage);
    }
}