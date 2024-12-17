<?php

namespace App\User\Adapters\Controllers;


use App\Shared\Controllers\BaseController;
use App\User\Domain\Services\CreateUserService;
use App\User\Domain\Services\FindUserByIdService;
use App\User\Domain\Services\ListUsersService;
use App\User\Domain\Services\ProjectUsersService;
use App\User\Http\Requests\CreateUserRequest;
use App\User\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request; 


class UserController extends BaseController
{
    private CreateUserService $createUserService;
    private ListUsersService $listUsersService;
    private FindUserByIdService $findUserByIdService;
    private ProjectUsersService $listProjectService;

    public function __construct(ProjectUsersService $listProjectService,CreateUserService $createUserService, ListUsersService $listUsersService, FindUserByIdService $findUserByIdService)
    {
        $this->createUserService = $createUserService;
        $this->listUsersService = $listUsersService;
        $this->findUserByIdService = $findUserByIdService;
        $this->listProjectService = $listProjectService;
    }

    public function index(Request $request)
    {
        $perPage = $this->getPerPage($request);
        $users = $this->listUsersService->execute($perPage);
        return UserResource::collection($users);
    }

    public function projects()
    {
        $response = $this->listProjectService->execute();
        return new UserResource($response);
    }

    public function tasks()
    {
        $response = $this->listProjectService->execute();
        return new UserResource($response);
    }

    
    public function store(CreateUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $this->createUserService->execute($data);
        return (new UserResource($user))->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $user = $this->findUserByIdService->execute($id);
        return (new UserResource($user));
    }
}
