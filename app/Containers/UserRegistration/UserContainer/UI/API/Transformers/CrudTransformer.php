<?php

namespace App\Containers\UserRegistration\UserContainer\UI\API\Transformers;

use App\Containers\UserRegistration\UserContainer\Models\Crud;
use App\Ship\Parents\Transformers\Transformer;

class CrudTransformer extends Transformer
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

    public function transform(Crud $crud): array
    {
        $response = [
            'object' => $crud->getResourceKey(),
            'id' => $crud->getHashedKey(),
            'created_at' => $crud->created_at,
            'updated_at' => $crud->updated_at,
            'readable_created_at' => $crud->created_at->diffForHumans(),
            'readable_updated_at' => $crud->updated_at->diffForHumans(),

        ];

        $response = $this->ifAdmin([
            'real_id'    => $crud->id,
            // 'deleted_at' => $crud->deleted_at,
        ], $response);

        return $response;
    }
}
