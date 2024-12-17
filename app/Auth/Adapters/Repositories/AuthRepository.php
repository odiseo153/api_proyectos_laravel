<?php

namespace App\Auth\Adapters\Repositories;

use App\Abilities\Abilities;
use App\Auth\Domain\Contracts\AuthRepositoryPort;
use App\Auth\Domain\Entities\User;
use App\Auth\Domain\Exceptions\InvalidCredentialsException;
use Illuminate\Support\Facades\Auth;
use App\Models\User as UserModel;


class AuthRepository implements AuthRepositoryPort
{
    public function login(User $user): array | null
    {
        if (Auth::attempt(['username' => $user->username, 'password' => $user->password])) {
            $authenticatedUser = UserModel::where('username', $user->username)->first();

            $token = $authenticatedUser->createToken('token', Abilities::getAbilities($authenticatedUser), now()->addHours(15))->plainTextToken;
            return [
                'data' => [
                    'token' => $token,
                    'username' => $authenticatedUser->username,
                    'name' => $authenticatedUser->name,
                    'role' => $authenticatedUser->role,
                ],
                'message' => 'Authenticated'
            ];
        }

        throw new InvalidCredentialsException();
    }

    public function logout(): void
    {
        Auth::user()->tokens()->delete();
    }

    public function me(): array | null
    {
        $authenticatedUser = Auth::user();
        return [
            'data' => [
                'username' => $authenticatedUser->username,
                'name' => $authenticatedUser->name,
                'role' => $authenticatedUser->role,
            ],
            'message' => 'Authenticated'
        ];
    }
}
