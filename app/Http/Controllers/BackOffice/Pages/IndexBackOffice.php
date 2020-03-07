<?php

namespace App\Http\Controllers\BackOffice\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Varejo\Model\CSC\RegistroOperador;
use App\Varejo\Model\CSC\Acordo;
use App\Varejo\Model\CSC\PP;
use App\Varejo\Model\CSC\Desfavoravel;
use App\Varejo\Model\CSC\Recusa;
use App\Varejo\Model\CSC\tb_csc_acordo_status;

class IndexBackOffice extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        set_time_limit(120);
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $macordo = new Acordo();
        $mpp = new PP();
        $mdesfavoravel = new Desfavoravel();
        $mdrecusa = new Recusa();

        $saida = array(
            'getNumberPreventivo' => $macordo->getPreventivoAcordos(),
            'jetValorPreventivoFinanciado' => $macordo->getPreventivoValorFinanciadoMes(),
            'DataExtenso' => strftime('%B', strtotime('today')),
            'AllPP' => $mpp->getPreventivoPP(),
            'countPP' => $mpp->getPreventivoPPCount(),
            'sumDesfavoravel' => $mdesfavoravel->getPreventivoDesfavoravel(),
            'countDesvaforavel' => $mdesfavoravel->getPreventivoDesvaforavelCount(),
            'sumRecusa' => $mdrecusa->getPreventivoRecusa(),
            'countRecusa' => $mdrecusa->getPreventivoRecusaCount()
        );

        return $saida;
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

    // get acordos number preventivo
    private function getPreventivoAcordos()
    {
        $acordosPreventivoNumber =  RegistroOperador::join('tb_csc_acordo','tb_csc_registro_operador.id','=','tb_csc_acordo.id_acordo_fk')
            ->whereBetween('datareg', [date('Y-08-01'),date('Y-08-31')])
            ->count();

        return $acordosPreventivoNumber ;
    }

    // get acordos number preventivo
    private function getPreventivoValorFinanciadoMes()
    {
        $ValorPreventivoFinanciadoMes =  RegistroOperador::join('tb_csc_acordo','tb_csc_registro_operador.id','=','tb_csc_acordo.id_acordo_fk')
            ->whereBetween('datareg', [date('Y-08-01'),date('Y-08-31')])
            ->sum('valor_financiado');

        return $ValorPreventivoFinanciadoMes ;
    }

    //get all acords mes
    private function  getAllAcords()
    {
        $acordosAll = RegistroOperador::join('tb_csc_acordo','tb_csc_registro_operador.id','=','tb_csc_acordo.id_acordo_fk')
            ->whereBetween('datareg', [date('Y-08-01'),date('Y-08-31')])
            ->get();

        return $acordosAll;
    }

}
