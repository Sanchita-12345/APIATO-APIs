<?php

namespace App\Containers\UserRegistration\UserContainer\Actions;

use App\Containers\UserRegistration\UserContainer\Models\UserContainer;
use App\Containers\UserRegistration\UserContainer\Tasks\CreateUserContainerTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateUserContainerAction extends Action
{
    public function run(Request $request): UserContainer
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(CreateUserContainerTask::class)->run($data);
    }
}
