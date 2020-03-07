<?php

namespace App\Varejo\Model\CSC;

use Illuminate\Database\Eloquent\Model;
use App\Varejo\Model\CSC\RegistroOperador;

class Recusa extends Model
{
    protected $table = 'tb_csc_recusa';

    public function getPreventivoRecusa()
    {
        return $recusaPreventivoNumber =  RegistroOperador::join('tb_csc_recusa','tb_csc_registro_operador.id','=','tb_csc_recusa.id_recusa_csc_fk')
            ->whereBetween('datareg', [date('Y-m-01'),date('Y-m-t')])
            ->sum('valor');
    }

    public function getPreventivoRecusaCount()
    {
        return $recusaPreventivoNumber =  RegistroOperador::join('tb_csc_recusa','tb_csc_registro_operador.id','=','tb_csc_recusa.id_recusa_csc_fk')
            ->whereBetween('datareg', [date('Y-m-01'),date('Y-m-t')])
            ->count();
    }

}
