<?php

namespace App\Containers\AppSection\UserNew\Actions;

use App\Containers\AppSection\UserNew\Tasks\DeleteUserNewTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteUserNewAction extends Action
{
    public function run(Request $request)
    {
        return app(DeleteUserNewTask::class)->run($request->id);
    }
}
