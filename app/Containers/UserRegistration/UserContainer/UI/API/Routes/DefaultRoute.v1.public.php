<?php

/**
 * @apiGroup           UserContainer
 * @apiName            Controller
 *
 * @api                {GET} /v1/hello Endpoint title here..
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
use App\Containers\UserRegistration\UserContainer\UI\API\Controllers\HelloController;
use Illuminate\Support\Facades\Route;

Route::get('hello', [HelloController::class, 'sayHello']);
    // ->name('api_usercontainer_controller')
    // ->middleware(['auth:api']);

