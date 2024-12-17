<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['lider','admin']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        return $project->leader_id == $user->id || $user->hasRole("admin");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        return ($user->hasRole('lider') && $project->leader_id == $user->id) || $user->hasRole("admin");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $project): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        return false;
    }
}




/*
$this->authorize('view', $task); // Ver tarea
$this->authorize('create', [Task::class, $project]); // Crear tarea
$this->authorize('update', $task); // Actualizar tarea
$this->authorize('updateStatus', $task); // Actualizar estado
$this->authorize('comment', $task); // Comentar en tarea

*/