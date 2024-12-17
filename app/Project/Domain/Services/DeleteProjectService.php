<?php

namespace App\Project\Domain\Services;

use App\Project\Domain\Contracts\ProjectRepositoryPort;
use App\Project\Domain\Entities\Project;

class DeleteProjectService
{
    private ProjectRepositoryPort $projectRepository;
    public function __construct(ProjectRepositoryPort $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function execute($id)
    {
        return $this->projectRepository->delete($id);
    }
}




