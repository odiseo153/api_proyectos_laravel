<?php

namespace App\Project\Domain\Entities;

class Project
{
    public $id;
    public $name;
    public $description;
    public $status;
    public $leader_id;
    public $create_by;
    public $createBy;
    public $leader;
    public $members;
    public $created_at;
    public $updated_at;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->status = $data['status'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->leader_id = $data['leader_id'] ?? null;
        $this->create_by = $data['create_by'] ?? null;
        $this->createBy = $data['createBy'] ?? null;
        $this->leader = $data['leader'] ?? null;
        $this->members = $data['members'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;

    }
}