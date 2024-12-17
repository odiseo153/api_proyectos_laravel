<?php

namespace App\Project\Domain\Contracts;

use App\Project\Domain\Entities\Project;

interface ProjectRepositoryPort
{
    public function create(Project $data);
    public function getAll(int $perPage);
    public function findById($id);
    public function delete($id);
    public function toggle_group($id);
    public function update(array $data,$id);
}