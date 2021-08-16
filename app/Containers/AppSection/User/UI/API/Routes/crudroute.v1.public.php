<?php

/**
 * @apiGroup           User
 * @apiName            Controller
 *
 * @api                {POST} /v1/note Endpoint title here..
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
use Illuminate\Support\Facades\Route;

Route::post('uploadnote', [Controller::class, 'uploadNote']);
    // ->name('api_user_controller')
    // ->middleware(['auth:api']);
Route::get('getnote', [Controller::class, 'displayNote']);
// ->name('api_user_controller')
    // ->middleware(['auth:api']);
Route::delete('deletenote/{id}', [Controller::class, 'deleteNote']);
// ->name('api_user_controller')
    // ->middleware(['auth:api']);
Route::post('updatenote', [Controller::class, 'updateNote']);
// ->name('api_user_controller')
    // ->middleware(['auth:api']);
