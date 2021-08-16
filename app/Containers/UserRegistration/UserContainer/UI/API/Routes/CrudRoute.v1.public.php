<?php

/**
 * @apiGroup           UserContainer
 * @apiName            CrudController
 *
 * @api                {POST} /v1/crud Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

use App\Containers\UserRegistration\UserContainer\UI\API\Controllers\Controller;
use App\Containers\UserRegistration\UserContainer\UI\API\Controllers\CrudController;
use Illuminate\Support\Facades\Route;

Route::post('crud', [CrudController::class, 'createUserContainer'])
    ->name('api_usercontainer_crud_controller')
    ->middleware(['auth:api']);

