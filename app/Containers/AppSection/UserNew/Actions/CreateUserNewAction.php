<?php

namespace App\Containers\AppSection\UserNew\Actions;

use App\Containers\AppSection\UserNew\Models\UserNew;
use App\Containers\AppSection\UserNew\Tasks\CreateUserNewTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateUserNewAction extends Action
{
    public function run(Request $request): UserNew
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(CreateUserNewTask::class)->run($data);
    }
}
