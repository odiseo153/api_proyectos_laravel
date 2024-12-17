<?php

namespace App\Shared\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;

abstract class BaseRepository
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getAll(int $perPage, array $filters = [], array $sorts = [], string $defaultSort = 'updated_at', array $with = [])
    {
        $perPage = max(1, min($perPage, 1000));

        return QueryBuilder::for($this->model)
            ->allowedFilters($filters)
            ->allowedSorts($sorts)
            ->defaultSort($defaultSort)
            ->with($with)
            ->paginate($perPage);
    }
}
