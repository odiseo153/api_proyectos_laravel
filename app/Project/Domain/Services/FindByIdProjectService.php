<?php

namespace App\Project\Domain\Services;


use App\Project\Domain\Contracts\ProjectRepositoryPort;

class FindByIdProjectService
{
    private ProjectRepositoryPort $projectRepository;
    public function __construct(ProjectRepositoryPort $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function execute($id)
    {
        return $this->projectRepository->findById($id);
    }
}