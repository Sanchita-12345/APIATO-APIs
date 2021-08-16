<?php

namespace App\Containers\AppSection\User\Models;

use App\Containers\AppSection\Authentication\Traits\AuthenticationTrait;
use App\Containers\AppSection\Authorization\Traits\AuthorizationTrait;
use App\Ship\Parents\Models\UserModel;
use Illuminate\Notifications\Notifiable;
use App\Ship\Parents\Models\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements JWTSubject
{
    use AuthorizationTrait;
    use AuthenticationTrait;
    use Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'birth',
        'device',
        'platform',
    ];

    protected $hidden = [
        
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }
}
