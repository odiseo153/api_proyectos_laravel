<?php

namespace App\Shared\Controllers;

use Illuminate\Http\Request;

abstract class BaseController
{

    protected function getPerPage(Request $request, int $default = 100, int $max = 1000): int
    {
        $perPage = $request->query('per_page', $default);
        return max(1, min($perPage, $max));
    }
}
