<?php

namespace App\Containers\UserRegistration\UserContainer\UI\API\Controllers;

use App\Ship\Parents\Controllers\ApiController;
use App\Containers\UserRegistration\UserContainer\Models\UserContainer;
use Illuminate\Http\Request;
use Validator;
use JWTAuth;

class UserController extends ApiController
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'fullname'=>'required|string|between:3,15',
            'email'=>'required|email|unique:users',
            'password'=>'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'mobile'=>'required|digits:10'
        ]);

        $user = new UserContainer([
            'fullname'=> $request->input('fullname'),
            'email'=> $request->input('email'),
            'password'=> bcrypt($request->input('password')),
            'mobile'=> $request->input('mobile'),
        ]);

        $user->save();

        return response()->json([
            'message'=>'Successfully Created user'
        ],201);
     }

     public function login(Request $request)
     {
        $req = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|
            min:5',
        ]);

        $email = $request->get('email');
        $user = UserContainer::where('email', $email)->first();
        
            if (!$user) {
            return response()->json(['status' => 400, 'message' => "Invalid credentials! email doesn't exists"]);
        }
        $token = JWTAuth::fromUser($user);
        if(!$token){
            return response()->json(['status' => 401, 'message' => 'Unauthenticated']);
        }
        return $this->generateToken($token);
    }
 
     public function generateToken($token)
     {
         return response()->json([
             'status' => 201,
             'message' => 'succesfully logged in',
             'token' => $token
         ]);
     }
}
