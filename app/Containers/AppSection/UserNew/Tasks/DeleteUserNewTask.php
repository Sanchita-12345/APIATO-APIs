<?php

namespace App\Containers\AppSection\UserNew\Tasks;

use App\Containers\AppSection\UserNew\Data\Repositories\UserNewRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteUserNewTask extends Task
{
    protected UserNewRepository $repository;

    public function __construct(UserNewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id): ?int
    {
        try {
            return $this->repository->delete($id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
