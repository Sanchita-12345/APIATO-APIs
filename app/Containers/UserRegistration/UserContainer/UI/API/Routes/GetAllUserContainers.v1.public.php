<?php

/**
 * @apiGroup           UserContainer
 * @apiName            getAllUserContainers
 *
 * @api                {GET} /v1/postuser Endpoint title here..
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
use Illuminate\Support\Facades\Route;

Route::get('postuser', [Controller::class, 'getAllUserContainers'])
    ->name('api_usercontainer_get_all_user_containers')
    ->middleware(['auth:api']);

