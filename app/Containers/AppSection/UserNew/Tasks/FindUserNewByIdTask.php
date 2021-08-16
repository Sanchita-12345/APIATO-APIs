<?php

namespace App\Containers\AppSection\UserNew\Tasks;

use App\Containers\AppSection\UserNew\Data\Repositories\UserNewRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindUserNewByIdTask extends Task
{
    protected UserNewRepository $repository;

    public function __construct(UserNewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
