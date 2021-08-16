<?php

namespace App\Containers\AppSection\UserNew\Tasks;

use App\Containers\AppSection\UserNew\Data\Repositories\UserNewRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateUserNewTask extends Task
{
    protected UserNewRepository $repository;

    public function __construct(UserNewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            return $this->repository->create($data);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
