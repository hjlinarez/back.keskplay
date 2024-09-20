<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users_opera';
    
    protected $fillable = ['email', 'password'];
    //protected $hidden = [];
    public $timestamps = false;

    /*public function username()
    {
        return 'usuario';
    }

    public function password()
    {
        return 'clave';
    }

    public function setPassword(string $password){
        $this->clave = $password;
    }

    public function getPassword(): string {
        return $this->clave;
    }

    public function setEmail(string $email){
        $this->usuario = $email;
    }

    public function getEmail(): string {
        return $this->usuario;
    }

    public function setName(string $name){
        $this->nombre_agente = $name;
    }

    public function getName(): string {
        return $this->nombre_agente;
    }*/



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    //protected $casts = ['email_verified_at' => 'datetime',];
}
