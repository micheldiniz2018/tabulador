<?php

namespace App\Varejo\Model\CSC;

use Illuminate\Database\Eloquent\Model;
use App\Varejo\Model\CSC\RegistroOperador;

class Acordo extends Model
{
    protected $table = 'tb_csc_acordo';

    function Operador()
    {
        return $this->belongsTo('App\Varejo\Model\CSC\RegistroOperador');
    }

    // get acordos number preventivo
    public function getPreventivoAcordos()
    {
        return $acordosPreventivoNumber =  RegistroOperador::join('tb_csc_acordo','tb_csc_registro_operador.id','=','tb_csc_acordo.id_acordo_fk')
            ->whereBetween('datareg', [date('Y-m-01'),date('Y-m-t')])
            ->count();
    }

    // get acordos number preventivo
    public function getPreventivoValorFinanciadoMes()
    {
        return $ValorPreventivoFinanciadoMes =  RegistroOperador::join('tb_csc_acordo','tb_csc_registro_operador.id','=','tb_csc_acordo.id_acordo_fk')
            ->whereBetween('datareg', [date('Y-m-01'),date('Y-m-t')])
            ->sum('valor_financiado');
    }

    // get acordos number preventivo search
    public function getPreventivoAcordosSearch($dainical,$datafinal)
    {
        return $acordosPreventivoNumber =  RegistroOperador::join('tb_csc_acordo','tb_csc_registro_operador.id','=','tb_csc_acordo.id_acordo_fk')
            ->whereBetween('datareg', [date('Y-m-d', strtotime($dainical)),date('Y-m-d', strtotime($datafinal))])
            ->count();
    }

    //get all acords mes
    public function  getAllAcords()
    {
        return $acordosAll = RegistroOperador::join('tb_csc_acordo','tb_csc_registro_operador.id','=','tb_csc_acordo.id_acordo_fk')
            ->whereBetween('datareg', [date('Y-m-01'),date('Y-m-t')])
            ->get();
    }

    //get acordos number preventivo search
    public function getPreventivoValorFinanciadoSearch($dainical,$datafinal)
    {
        return $ValorPreventivoFinanciadoMes =  RegistroOperador::join('tb_csc_acordo','tb_csc_registro_operador.id','=','tb_csc_acordo.id_acordo_fk')
            ->whereBetween('datareg', [date('Y-m-d', strtotime($dainical)),date('Y-m-d', strtotime($datafinal))])
            ->sum('valor_financiado');
    }


}
