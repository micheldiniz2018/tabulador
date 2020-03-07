<?php

namespace App\Http\Controllers\Operator\Varejo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Varejo\Model\CSC\Acordo;
use App\Varejo\Model\CSC\PP;
use App\Varejo\Model\CSC\Desfavoravel;
use App\Varejo\Model\CSC\RegistroOperador;
use App\Varejo\Model\CSC\Recusa;

class index extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usuario = Auth::user()->getAspect();
        //captura todos os acordos
        $acordos = RegistroOperador::join('tb_csc_acordo','tb_csc_registro_operador.id','=','tb_csc_acordo.id_acordo_fk')
            ->whereBetween('datareg', [date('Y-m-01'),date('Y-m-31')])
            ->where('aspect', 'like',$usuario)
            ->get();
        //captura a quantidade total de acordos
        $totalAcordos = RegistroOperador::join('tb_csc_acordo','tb_csc_registro_operador.id','=','tb_csc_acordo.id_acordo_fk')
            ->whereBetween('datareg', [date('Y-m-01'),date('Y-m-31')])
            ->where('aspect', 'like',$usuario)
            ->count();
        //captura a quantidade total de pp
        $totalPP = RegistroOperador::join('tb_csc_pp','tb_csc_registro_operador.id','=','tb_csc_pp.id_pp_csc_fk')
            ->whereBetween('datareg', [date('Y-m-01'),date('Y-m-31')])
            ->where('aspect', 'like',$usuario)
            ->count();
        //captura a quantidade total de recusa
        $totalRecusa = RegistroOperador::join('tb_csc_recusa','tb_csc_registro_operador.id','=','tb_csc_recusa.id_recusa_csc_fk')
            ->whereBetween('datareg', [date('Y-m-01'),date('Y-m-31')])
            ->where('aspect', 'like',$usuario)
            ->count();
        //captura a quantidade total de desfavoravel
        $totalDesfavoravel = RegistroOperador::join('tb_csc_desfavoravel','tb_csc_registro_operador.id','=','tb_csc_desfavoravel.id_desfavoravel_fk')
            ->whereBetween('datareg', [date('Y-m-01'),date('Y-m-31')])
            ->where('aspect', 'like',$usuario)
            ->count();

        return [$acordos, $totalAcordos,$totalPP,$totalRecusa,$totalDesfavoravel];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
