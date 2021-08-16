<?php

namespace App\Containers\AppSection\UserNew\UI\API\Controllers;

use App\Containers\AppSection\UserNew\UI\API\Requests\CreateUserNewRequest;
use App\Containers\AppSection\UserNew\UI\API\Requests\DeleteUserNewRequest;
use App\Containers\AppSection\UserNew\UI\API\Requests\GetAllUserNewsRequest;
use App\Containers\AppSection\UserNew\UI\API\Requests\FindUserNewByIdRequest;
use App\Containers\AppSection\UserNew\UI\API\Requests\UpdateUserNewRequest;
use App\Containers\AppSection\UserNew\UI\API\Transformers\UserNewTransformer;
use App\Containers\AppSection\UserNew\Actions\CreateUserNewAction;
use App\Containers\AppSection\UserNew\Actions\FindUserNewByIdAction;
use App\Containers\AppSection\UserNew\Actions\GetAllUserNewsAction;
use App\Containers\AppSection\UserNew\Actions\UpdateUserNewAction;
use App\Containers\AppSection\UserNew\Actions\DeleteUserNewAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function createUserNew(CreateUserNewRequest $request): JsonResponse
    {
        $usernew = app(CreateUserNewAction::class)->run($request);
        return $this->created($this->transform($usernew, UserNewTransformer::class));
    }

    public function findUserNewById(FindUserNewByIdRequest $request): array
    {
        $usernew = app(FindUserNewByIdAction::class)->run($request);
        return $this->transform($usernew, UserNewTransformer::class);
    }

    public function getAllUserNews(GetAllUserNewsRequest $request): array
    {
        $usernews = app(GetAllUserNewsAction::class)->run($request);
        return $this->transform($usernews, UserNewTransformer::class);
    }

    public function updateUserNew(UpdateUserNewRequest $request): array
    {
        $usernew = app(UpdateUserNewAction::class)->run($request);
        return $this->transform($usernew, UserNewTransformer::class);
    }

    public function deleteUserNew(DeleteUserNewRequest $request): JsonResponse
    {
        app(DeleteUserNewAction::class)->run($request);
        return $this->noContent();
    }
}
