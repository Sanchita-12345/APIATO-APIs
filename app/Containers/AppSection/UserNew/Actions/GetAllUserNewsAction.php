<?php

namespace App\Containers\AppSection\UserNew\Actions;

use App\Containers\AppSection\UserNew\Tasks\GetAllUserNewsTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetAllUserNewsAction extends Action
{
    public function run(Request $request)
    {
        return app(GetAllUserNewsTask::class)->addRequestCriteria()->run();
    }
}
