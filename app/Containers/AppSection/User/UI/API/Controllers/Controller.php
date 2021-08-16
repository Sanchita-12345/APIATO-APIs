<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\User\Actions\CreateAdminAction;
use App\Containers\AppSection\User\Actions\DeleteUserAction;
use App\Containers\AppSection\User\Actions\FindUserByIdAction;
use App\Containers\AppSection\User\Actions\ForgotPasswordAction;
use App\Containers\AppSection\User\Actions\GetAllAdminsAction;
use App\Containers\AppSection\User\Actions\GetAllClientsAction;
use App\Containers\AppSection\User\Actions\GetAllUsersAction;
use App\Containers\AppSection\User\Actions\GetAuthenticatedUserAction;
use App\Containers\AppSection\User\Actions\RegisterUserAction;
use App\Containers\AppSection\User\Actions\ResetPasswordAction;
use App\Containers\AppSection\User\Actions\UpdateUserAction;
use App\Containers\AppSection\User\Models\Display;
use App\Containers\AppSection\User\UI\API\Requests\CreateAdminRequest;
use App\Containers\AppSection\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\AppSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\AppSection\User\UI\API\Requests\ForgotPasswordRequest;
use App\Containers\AppSection\User\UI\API\Requests\GetAllUsersRequest;
use App\Containers\AppSection\User\UI\API\Requests\GetAuthenticatedUserRequest;
use App\Containers\AppSection\User\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\User\UI\API\Requests\ResetPasswordRequest;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserPrivateProfileTransformer;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use App\Containers\AppSection\User\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Payload;
use DB;
use Exception;

class Controller extends ApiController
{
    public function registerUser(RegisterUserRequest $request): array
    {
        $user = app(RegisterUserAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    public function createAdmin(CreateAdminRequest $request): array
    {
        $admin = app(CreateAdminAction::class)->run($request);
        return $this->transform($admin, UserTransformer::class);
    }

    public function updateUser(UpdateUserRequest $request): array
    {
        $user = app(UpdateUserAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    public function deleteUser(DeleteUserRequest $request): JsonResponse
    {
        app(DeleteUserAction::class)->run($request);
        return $this->noContent();
    }

    public function getAllUsers(GetAllUsersRequest $request): array
    {
        $users = app(GetAllUsersAction::class)->run();
        return $this->transform($users, UserTransformer::class);
    }

    public function getAllClients(GetAllUsersRequest $request): array
    {
        $users = app(GetAllClientsAction::class)->run();
        return $this->transform($users, UserTransformer::class);
    }

    public function getAllAdmins(GetAllUsersRequest $request): array
    {
        $users = app(GetAllAdminsAction::class)->run();
        return $this->transform($users, UserTransformer::class);
    }

    public function findUserById(FindUserByIdRequest $request): array
    {
        $user = app(FindUserByIdAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    public function getAuthenticatedUser(GetAuthenticatedUserRequest $request): array
    {
        $user = app(GetAuthenticatedUserAction::class)->run();
        return $this->transform($user, UserPrivateProfileTransformer::class);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        app(ResetPasswordAction::class)->run($request);
        return $this->noContent(204);
    }

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        app(ForgotPasswordAction::class)->run($request);
        return $this->noContent(202);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|string|between:3,15',
            'email'=>'required|email|unique:users',
            'password'=>'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'gender'=>'required|string|between:3:10',
            'birth'=>'required|string|between:3:10',
            'device'=>'required|string|between:3:10',
            'platform'=>'required|string|between:3:10'

        ]);

        $user = new User([
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'password'=> bcrypt($request->input('password')),
            'gender'=> $request->input('gender'),
            'birth'=> $request->input('birth'),
            'device'=> $request->input('device'),
            'platform'=> $request->input('platform'),
        ]);

        $user->save();

        return response()->json([
            'message'=>'Successfully Created user'
        ],201);
     }

     public function login(RegisterUserRequest $request)
     {
        $req = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|
            min:5',
        ]);

        $email = $request->get('email');
        $user = User::where('email', $email)->first();
        
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

    //  public function payload(){
    //     $user=new Display();
    //     $token=JWTAuth::getToken();
    //     $id=JWTAuth::getPayload($token)->toArray();
    //     $user->user_id = $id["sub"];
    //     return DB::table('notes')->where('user_id', $user->user_id)->get();
    //  }

     public function uploadNote(Request $request)
     {
         $note = new Display();
         $note->title = $request->input('title');
         $note->description = $request->input('description');
         $token=$request->bearerToken();
         $tokenParts = explode(".", $token); 
         $tokenPayload = base64_decode($tokenParts[1]);
         $jwtPayload = json_decode($tokenPayload);
         $note->user_id = $jwtPayload->sub;
         $note->save();
         return response()->json(['success' => 'note Added successfully']);
     }
     public function displayNote()
     {
        //  $user = new Display();
        $user=User::all();
         $token = JWTAuth::getToken();
         $id = JWTAuth::getPayload($token)->toArray();
         $user->user_id = $id["sub"];
         return DB::table('notes')->where('user_id', $user->user_id)->get();
     }
     public function deleteNote($id){
        $note = new Display();
        $note->id = $id;
        $token = JWTAuth::getToken();
        $id = JWTAuth::getPayload($token)->toArray();
        $note->user_id = $id["sub"];
    //    return $note->id;
        $noteId = Display::where('id', $note->id)->value('id');
        // $noteId = Display::findOrFail($id);
        $note->delete();
        if($noteId == $note->id){
            Display::where('id', $note->id)->delete();
            return response()->json(['status' => 201, 'message' => 'note deleted successfully']);
        }
        return response()->json(['status' => 409, 'message' => 'No note is available with this given Id']);
    }

    public function updateNote(Request $request){
        $note = new Display();
        $note->id = $request->input('id');
        // return $note->id;
        $token = JWTAuth::getToken();
        $id = JWTAuth::getPayload($token)->toArray();
        $note->user_id = $id["sub"];

        $userId = User::where('id', $note->user_id)->value('id');
        if(!$userId){
            return response()->json(['status' => 409,'message'=>'No admin is present in this id']);
        }
        $note->user_id = $userId;
        $note->title = $request->input('title');
        $note->description = $request->input('description');
        // return $note;
            Display::where('id',$note->id)->update(
            ['title'=>$note->title,
             'description'=>$note->description,
            ]);   
            // $note->save();         
            return response()->json(['status' => 201, 'message' => 'note updated successfully']);
    }
}