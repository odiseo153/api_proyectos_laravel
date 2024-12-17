<?php

namespace App\Project\Domain\Services;

use App\Project\Domain\Contracts\ProjectRepositoryPort;
use App\Project\Domain\Entities\Project;

class CreateProjectService
{
    private ProjectRepositoryPort $projectRepository;
    public function __construct(ProjectRepositoryPort $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function execute(array $data)
    {
        $project = new Project($data);
        $response = $this->projectRepository->create($project);
        return $response;
    }
}