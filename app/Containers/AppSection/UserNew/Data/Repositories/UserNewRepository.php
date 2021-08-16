<?php

namespace App\Containers\AppSection\UserNew\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class UserNewRepository extends Repository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
}
