<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Context;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable,HasUlids;


    private $roles = ['admin','lider','miembro'];

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    /**
     * Relación con proyectos como miembro.
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_user');
    }
    
    /**
     * Relación con tareas asignadas.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class,'assigned_to');
    }
    public function hasRole($role)
    {
        return $this->role === strtolower($role);
    }

    public function hasAnyRole(array $roles)
    {
        return in_array($this->role, array_map('strtolower', $roles));
    }
}



