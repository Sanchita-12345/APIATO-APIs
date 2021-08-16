<?php

/**
 * @apiGroup           UserNew
 * @apiName            createUserNew
 *
 * @api                {POST} /v1/usernew Endpoint title here..
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

use App\Containers\AppSection\UserNew\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('usernew', [Controller::class, 'createUserNew'])
    ->name('api_usernew_create_user_new')
    ->middleware(['auth:api']);

