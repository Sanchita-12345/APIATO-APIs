<?php

namespace App\Containers\AppSection\UserNew\Actions;

use App\Containers\AppSection\UserNew\Models\UserNew;
use App\Containers\AppSection\UserNew\Tasks\UpdateUserNewTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateUserNewAction extends Action
{
    public function run(Request $request): UserNew
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(UpdateUserNewTask::class)->run($request->id, $data);
    }
}
