<?php

/**
 * @apiGroup           User
 * @apiName            DisplayController
 *
 * @api                {POST} /v1/create Endpoint title here..
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

use App\Containers\AppSection\User\UI\API\Controllers\Controller;
use App\Containers\AppSection\User\UI\API\Controllers\DisplayController;
use Illuminate\Support\Facades\Route;

// Route::group(["middleware"=>['auth.jwt']],function(){
//   Route::post('display', [Controller::class, 'display']);
//   });

// Route::post('note',[Controller::class,'display'])

// ->middleware('auth:jwt');
