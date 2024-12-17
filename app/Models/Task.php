<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
        'status',
        'project_id',
        'assigned_to',
    ];

    /**
     * Relación con el proyecto.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    /**
     * Relación con el usuario asignado.
     */
    public function assigned(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
