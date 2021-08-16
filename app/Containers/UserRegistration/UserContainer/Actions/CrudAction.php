<?php

namespace App\Containers\UserRegistration\UserContainer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use App\Containers\UserRegistration\UserContainer\Models\Crud;
use App\Containers\UserRegistration\UserContainer\Tasks\CrudTask;

class CrudAction extends Action
{
    public function run(Request $request): Crud
    {
        // $var = app(Task::class)->run($arg1, $arg2);
        $data = $request->sanitizeInput([
            // add your request data here
        ]);
        return app(CrudTask::class)->run($data);
    }
}
