<?php

namespace App\Containers\AppSection\UserNew\Tasks;

use App\Containers\AppSection\UserNew\Data\Repositories\UserNewRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateUserNewTask extends Task
{
    protected UserNewRepository $repository;

    public function __construct(UserNewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
