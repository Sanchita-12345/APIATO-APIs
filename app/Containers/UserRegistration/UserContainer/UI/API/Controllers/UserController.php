<?php

namespace App\Containers\UserRegistration\UserContainer\UI\API\Controllers;

use App\Containers\AppSection\User\Models\Display;
use App\Containers\UserRegistration\UserContainer\Models\Crud;
use App\Ship\Parents\Controllers\ApiController;
use App\Containers\UserRegistration\UserContainer\Models\UserContainer;
use Illuminate\Http\Request;
use Validator;
use JWTAuth;
use DB;

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
        // return $this->payload($token);
    }
 
     public function generateToken($token)
     {
         return response()->json([
             'status' => 201,
             'message' => 'succesfully logged in',
             'token' => $token
         ]);
     }

    //  public function payload(){
    //     //  $request->header($token);
    //     // $token=JWTAuth::getToken();
    // //    $apy=JWTAuth::getPayload($token)->toArray();
    // //    return response()->json(['payload'=>$apy]);
    //     //  $base64Url=$token.split('.')[1];
    //     //  $base64=$base64Url.replace('-','+').replace('_','/');
    //     //  return JSON.parse($window.atob($base64));
    //     $user=new Display();
    //     $token=JWTAuth::getToken();
    //     $id=JWTAuth::getPayload($token)->toArray();
    //     $user->user_id = $id["id"];
    //     return DB::table('notes')->where('user_id', $user->user_id)->get();
    //  }

    //  public function upload(Request $request)
    //  {
    //      $note = new Crud();
    //      $note->title = $request->input('title');
    //      $note->description = $request->input('description');
    //      $token=$request->bearerToken();
    //      $tokenParts = explode(".", $token); 
    //      //$tokenHeader = base64_decode($tokenParts[0]);
    //      $tokenPayload = base64_decode($tokenParts[1]);
    //      //$jwtHeader = json_decode($tokenHeader);
    //      $jwtPayload = json_decode($tokenPayload);
    //      $note->user_id=$jwtPayload->sub;
    //      $note->save();
    //      return response()->json(['success' => 'note Added successfully']);
    //  }
}
