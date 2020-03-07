<?php

namespace App\Varejo\Model\CSC;

use Illuminate\Database\Eloquent\Model;
use App\Varejo\Model\CSC\RegistroOperador;

class Desfavoravel extends Model
{
    protected $table = 'tb_csc_desfavoravel';

    public function getPreventivoDesfavoravel()
    {
        return $acordosPreventivoNumber =  RegistroOperador::join('tb_csc_desfavoravel','tb_csc_registro_operador.id','=','tb_csc_desfavoravel.id_desfavoravel_fk')
            ->whereBetween('datareg', [date('Y-m-01'),date('Y-m-t')])
            ->sum('valor');
    }

    public function getPreventivoDesvaforavelCount()
    {
        return $acordosPreventivoNumber =  RegistroOperador::join('tb_csc_desfavoravel','tb_csc_registro_operador.id','=','tb_csc_desfavoravel.id_desfavoravel_fk')
            ->whereBetween('datareg', [date('Y-m-01'),date('Y-m-t')])
            ->count();
    }

}
