<?php

namespace App\Containers\AppSection\User\Models;

use App\Ship\Parents\Models\Model;

class Display extends Model
{
    protected $table ='notes';
    protected $fillable = [
        'title',
        'description'
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Display';
    public function user(){
        return $this->belongsTo('C:\xampp\htdocs\code\apiato\app\Containers\AppSection\User\Models\User.php','user_id');
        }
}
