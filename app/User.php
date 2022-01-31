<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable;
    // use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id_role', 'nim', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function isPanitia(){
        //jika role_name=Panitia maka benar
        if($this->id_role == 1){
            return true;
        }
            return false;
    }
    public function isPengurus(){
        //jika role_name=Pengurus maka benar
        if($this->id_role == 2){
            return true;
        }
            return false;
    }

    //membuat fungsi isMahasiswa untuk Mahasiswa
    public function isMahasiswa(){
        //jika role_name=mahasiswa maka benar
        if($this->id_role == 3){
            return true;
        }
            return false;
    }

}
