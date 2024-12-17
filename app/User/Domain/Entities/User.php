<?php

namespace App\User\Domain\Entities;

class User
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $username;
    public $projects;
    public $tasks;
    public $role;
    public $created_at;
    public $updated_at;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'];
        $this->email = $data['email'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->username = $data['username'];
        $this->role = $data['role'];
        $this->projects = $data['projects'];
        $this->tasks = $data['tasks'];
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;
    }
}
