<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctors extends Authenticatable
{
    use Notifiable;
    //
    protected $table ='doctors';
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function children()
    {
        return $this->hasMany(\App\Children::class, 'doctor_id' , 'id');//->withTrashed();
    }
}
