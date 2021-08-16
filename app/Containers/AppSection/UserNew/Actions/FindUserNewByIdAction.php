<?php

namespace App\Containers\AppSection\UserNew\Actions;

use App\Containers\AppSection\UserNew\Models\UserNew;
use App\Containers\AppSection\UserNew\Tasks\FindUserNewByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindUserNewByIdAction extends Action
{
    public function run(Request $request): UserNew
    {
        return app(FindUserNewByIdTask::class)->run($request->id);
    }
}
