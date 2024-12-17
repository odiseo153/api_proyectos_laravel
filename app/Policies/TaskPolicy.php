<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
     public function viewAny(User $user): bool
    {

        return $user->hasRole('admin') || $user->hasRole('lider');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        //dd($user);
        return ($user->hasRole('miembro') && $task->assigned_to == $user->id) || $user->hasAnyRole(['admin','lider']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
     //   dd($user);
        return ($user->hasRole('lider') ) 
        || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        return ($user->hasRole('lider') && $task->project()->firstWhere('leader_id','=',$user->id) ) || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task ): bool
    {
        return ($user->hasRole('lider') && $task->project()->id == $task->project_id) || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        return false;
    }
}
