<?php

namespace App\Containers\AppSection\UserNew\Tasks;

use App\Containers\AppSection\UserNew\Data\Repositories\UserNewRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllUserNewsTask extends Task
{
    protected UserNewRepository $repository;

    public function __construct(UserNewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
