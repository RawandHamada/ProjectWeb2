<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Children extends Authenticatable
{
    use Notifiable;
    //
    protected $table ='children';
    protected $fillable = [
        'child_id', 'name', 'gender','birth_of_date','age','doctor_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public static $enum_gender = ["male" => "Male", "female" => "Female"];

    public function vital(){
        return $this->hasOne('App\VitalSigns','child_id','id');
    }
}
