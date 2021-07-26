<?php

namespace App\Containers\UserRegistration\UserContainer\Actions;

use App\Containers\UserRegistration\UserContainer\Tasks\GetAllUserContainersTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetAllUserContainersAction extends Action
{
    public function run(Request $request)
    {
        return app(GetAllUserContainersTask::class)->addRequestCriteria()->run();
    }
}
