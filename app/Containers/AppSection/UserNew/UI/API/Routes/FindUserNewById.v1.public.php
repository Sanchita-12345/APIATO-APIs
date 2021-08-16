<?php

/**
 * @apiGroup           UserNew
 * @apiName            findUserNewById
 *
 * @api                {GET} /v1/usernew/:id Endpoint title here..
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

Route::get('usernew/{id}', [Controller::class, 'findUserNewById'])
    ->name('api_usernew_find_user_new_by_id')
    ->middleware(['auth:api']);

