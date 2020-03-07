<?php

namespace App\Varejo\Model\CSC;

use Illuminate\Database\Eloquent\Model;
use App\Varejo\Model\CSC\RegistroOperador;

class PP extends Model
{
    protected $table = 'tb_csc_pp';

    public function getPreventivoPP()
    {
        return $acordosPreventivoNumber =  RegistroOperador::join('tb_csc_pp','tb_csc_registro_operador.id','=','tb_csc_pp.id_pp_csc_fk')
            ->whereBetween('datareg', [date('Y-m-01'),date('Y-m-t')])
            ->sum('valor');
    }

    public function getPreventivoPPCount()
    {
        return $acordosPreventivoNumber =  RegistroOperador::join('tb_csc_pp','tb_csc_registro_operador.id','=','tb_csc_pp.id_pp_csc_fk')
            ->whereBetween('datareg', [date('Y-m-01'),date('Y-m-t')])
            ->count();
    }
}
