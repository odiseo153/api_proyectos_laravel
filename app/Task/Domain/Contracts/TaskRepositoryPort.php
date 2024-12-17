<?php

namespace App\Task\Domain\Contracts;

use App\Task\Domain\Entities\Task;

interface TaskRepositoryPort
{
    public function create(Task $data);
    public function getAll(int $perPage);
    public function findById($id);
    public function update(array $data,$id);
    public function delete($id);
}