<?php

/**
 * @apiGroup           UserNew
 * @apiName            deleteUserNew
 *
 * @api                {DELETE} /v1/usernew/:id Endpoint title here..
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

Route::delete('usernew/{id}', [Controller::class, 'deleteUserNew'])
    ->name('api_usernew_delete_user_new')
    ->middleware(['auth:api']);

