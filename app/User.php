<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username','foto', 'level'
    ];


    //Authentication & Events
    protected $dates = [
        'current_sign_in_at', 'last_sign_in_at',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Jemaat()
    {
       return $this->hasMany(Jemaat::class);
    }

    public function kategori()
    {
    	return $this->hasMany(Kategori::class);
    }

    public function petugas()
    {
       return $this->hasOne(Petugas::class);
    }
}
