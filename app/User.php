<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\superior;
use App\ilha;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'aspect', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isOperatorVarejo()
    {
        return ($this->cargos_id == 1);
    }

    public function isSuper()
    {
        return ($this->cargos_id == 2);
    }

    public function isBackOffice()
    {
        return ($this->cargos_id == 3);
    }
    /*
     *  get user information
     */
    public function getName()
    {
        return $this->name;
    }

    public function getUsuarioX()
    {
        return $this->usuariox;
    }

    public function getAspect()
    {
        return $this->aspect;
    }

    public function getSuperior()
    {
        $super = superior::find($this->superiors_id);
        return $super->name;
    }

    public function getIlha()
    {
        $ilha = ilha::find($this->ilha_id);
        return $ilha->ilha;
    }

    //get acc this month
    public function getAccMonth()
    {

    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
