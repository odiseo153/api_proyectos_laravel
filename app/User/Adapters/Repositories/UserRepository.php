<?php

namespace App\User\Adapters\Repositories;

use App\Shared\Repositories\BaseRepository;
use App\User\Domain\Contracts\UserRepositoryPort;
use App\User\Domain\Entities\User;
use App\Models\User as UserModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;


class UserRepository extends BaseRepository implements UserRepositoryPort
{
    public function __construct()
    {
        parent::__construct(UserModel::class);
    }

    public function getAll(int $perPage, array $filters = [], array $sorts = [], string $defaultSort = '-updated_at', array $with = []): LengthAwarePaginator
    {
        $filters = [
            'name'
        ];
        return parent::getAll($perPage, $filters, $sorts, $defaultSort, $with);
    }

    public function create(User $user): User
    {
        $userModel = UserModel::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'username' => $user->username,
            'role' => $user->role,
        ]);

        return new User($userModel->toArray());
    }

    public function findById(string $id): User
    {
        $userModel = UserModel::with(['projects','tasks'])->findOrFail($id);
        return new User($userModel->toArray());
    }

    public function projects()
    {
        $id = Auth::id();
        $userModel = UserModel::with(['projects'])->findOrFail($id);


        return new User($userModel->toArray());
    }

    public function tasks()
    {
        $id = Auth::id();
        $userModel = UserModel::with(['projects'])->findOrFail($id);


        return new User($userModel->toArray());
    }

   

    public function update(string $id, array $data): User
    {
        $userModel = UserModel::findOrFail($id);
        $userModel->update($data);
        return new User($userModel->toArray());
    }
}
