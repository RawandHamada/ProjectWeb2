<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class VitalSigns extends Authenticatable
{
    use Notifiable;
    //
    protected $table ='vital_signs';
    protected $fillable = [
        'child_id', 'length', 'temperature','respiratory_rate','size','heart_beat','blood_pressure'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function child_id(){
        return $this->hasOne('App\Children','id','child_id');
    }

}
