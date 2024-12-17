<?php

namespace App\Task\Domain\Entities;

class Task
{
    public $id;
    public $name;
    public $description;
    public $status;
    public $project;
    public $assigned_to;  
    public $assigned;  
    public $project_id;
    public $created_at;
    public $updated_at;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->status = $data['status'] ?? null;
        $this->project = $data['project'] ?? null;
        $this->assigned_to = $data['assigned_to'] ?? null;
        $this->assigned = $data['assigned'] ?? null;
        $this->project_id = $data['project_id'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;
    }
}