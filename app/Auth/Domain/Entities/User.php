<?php

namespace App\Auth\Domain\Entities;

class User
{
    public $username;
    public $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
}
