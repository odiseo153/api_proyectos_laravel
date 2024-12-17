<?php

namespace App\Auth\Domain\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class InvalidCredentialsException extends HttpException
{
    public function __construct()
    {
        parent::__construct(401, "Invalid credentials");
    }
}
