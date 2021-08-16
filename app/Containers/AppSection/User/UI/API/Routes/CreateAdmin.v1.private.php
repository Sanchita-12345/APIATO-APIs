<?php

/**
 * @apiGroup           User
 * @apiName            createAdmin
 * @api                {post} /v1/admins Create Admin type Users
 * @apiDescription     Create non client users for the Dashboard.
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  email
 * @apiParam           {String}  password
 * @apiParam           {String}  name
 *
 * @apiUse             UserSuccessSingleResponse
 */

use App\Containers\AppSection\User\UI\API\Controllers\Controller;
use App\Containers\AppSection\User\UI\API\Controllers\DisplayController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [Controller::class, 'login']);
    // ->name('api_user_create_admin')
    // ->middleware(['auth:api']);
// Route::post('admins',[DisplayController::class, 'createUser']);
Route::post('/payload', [Controller::class, 'getToken']);