<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Information;

class Student extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table = 'students';
    protected $fillable = [
        'name','student_number','college','phone','reason'
    ];
    protected $hidden = [
         'remember_token',
    ];
    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public  function  information()
    {
        return $this->hasOne(Information::class,'student_number','number');
    }
}
