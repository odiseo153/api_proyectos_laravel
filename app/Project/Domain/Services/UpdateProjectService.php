<?php

namespace App\Project\Domain\Services;

use App\Project\Domain\Contracts\ProjectRepositoryPort;
use App\Project\Domain\Entities\Project;

class UpdateProjectService
{
    private ProjectRepositoryPort $projectRepository;
    public function __construct(ProjectRepositoryPort $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function execute(array $data,$id)
    {
        return $this->projectRepository->update($data,$id);
    }
}