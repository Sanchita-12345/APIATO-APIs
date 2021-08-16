<?php

namespace App\Containers\AppSection\UserNew\UI\API\Transformers;

use App\Containers\AppSection\UserNew\Models\UserNew;
use App\Ship\Parents\Transformers\Transformer;

class UserNewTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    public function transform(UserNew $usernew): array
    {
        $response = [
            'object' => $usernew->getResourceKey(),
            'id' => $usernew->getHashedKey(),
            'created_at' => $usernew->created_at,
            'updated_at' => $usernew->updated_at,
            'readable_created_at' => $usernew->created_at->diffForHumans(),
            'readable_updated_at' => $usernew->updated_at->diffForHumans(),

        ];

        $response = $this->ifAdmin([
            'real_id'    => $usernew->id,
            // 'deleted_at' => $usernew->deleted_at,
        ], $response);

        return $response;
    }
}
