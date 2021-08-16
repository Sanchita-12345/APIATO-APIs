<?php

/**
 * @apiGroup           UserNew
 * @apiName            getAllUserNews
 *
 * @api                {GET} /v1/usernew Endpoint title here..
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

Route::get('usernew', [Controller::class, 'getAllUserNews'])
    ->name('api_usernew_get_all_user_news')
    ->middleware(['auth:api']);

