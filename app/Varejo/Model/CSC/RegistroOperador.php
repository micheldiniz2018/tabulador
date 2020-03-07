<?php

namespace App\Varejo\Model\CSC;

use Illuminate\Database\Eloquent\Model;

class RegistroOperador extends Model
{
    protected $table = 'tb_csc_registro_operador';

    function acordo()
    {
        return $this->hasMany('App\Varejo\Model\CSC\Acordo','id_acordo_fk');
    }

}
