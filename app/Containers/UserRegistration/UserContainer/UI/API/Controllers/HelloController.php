<?php

namespace App\Containers\UserRegistration\UserContainer\UI\API\Controllers;

use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\Request;
class HelloController extends ApiController
{
    public function sayHello(Request $request)
    {
        return response()->json([
            'message'=>'Hello World'
        ],201); 
    }
}
