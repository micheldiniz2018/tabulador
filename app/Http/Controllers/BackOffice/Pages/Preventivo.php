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
use Illuminate\Support\Carbon;
use App\Varejo\Model\CSC\Campanha;
use App\Varejo\Model\CSC\Fila;
use App\Varejo\Model\CSC\Negociacao;
use App\Varejo\Model\CSC\Taxa;
use App\Varejo\Model\CSC\AcordoBackoffice;
use App\Varejo\Model\CSC\Codigo;
use Illuminate\Support\Facades\Auth;

class Preventivo extends Controller
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

        $saida = array('getNumberPreventivo' => $macordo->getPreventivoAcordos(),
            'jetValorPreventivoFinanciado' => $macordo->getPreventivoValorFinanciadoMes(),
            'DataExtenso' => strftime('%B', strtotime('today')),
            'AllPP' => $mpp->getPreventivoPP(),
            'countPP' => $mpp->getPreventivoPPCount(),
            'sumDesfavoravel' => $mdesfavoravel->getPreventivoDesfavoravel(),
            'countDesvaforavel' => $mdesfavoravel->getPreventivoDesvaforavelCount(),
            'sumRecusa' => $mdrecusa->getPreventivoRecusa(),
            'countRecusa' => $mdrecusa->getPreventivoRecusaCount(),
            'AllStatus' => $this->getAllStatus());

        return view('backoffice.pages.preventivo.index', compact('saida'));
    }

    /**
     * All acords
     */
    public function acordo()
    {
        set_time_limit(120);
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $macordo = new Acordo();

        $fila = Fila::all();
        $campanha = Campanha::all();
        $negociacao = Negociacao::all();
        $taxa = Taxa::all();
        $codigo = Codigo::all();
        $negociacao = Negociacao::all();

        $acordos = RegistroOperador::join('tb_csc_acordo','tb_csc_registro_operador.id','=','tb_csc_acordo.id_acordo_fk')
            ->whereBetween('datareg', [date('Y-m-d'),date('Y-m-d')])
            ->get();

        $saida = array(
            'DataExtenso' => strftime('%B', strtotime('today')),
            'AllAcordos' => $macordo->getAllAcords(),
            'fila' => $fila,
            'campanha' => $campanha,
            'negociacao' => $negociacao,
            'taxa' => $taxa,
            'codigo' => $codigo,
            'AllStatus' => $this->getAllStatus());

        return view('backoffice.pages.preventivo.acordo', compact('saida','acordos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        set_time_limit(120);
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $regras = [
            'dtinical'  => 'required|date',
            'dtfinal' => 'required|date',
        ];

        $mensagens = [
            'dtinical.required' => ' Preencha a data inicial !',
            'dtfinal.required' => ' Preencha a data final !',
        ];

        $request->validate($regras, $mensagens);

        //verifica intervalo de datas
        $dtini = Carbon::createFromFormat('Y-m-d', $request->input('dtinical'));
        $dtfin = Carbon::createFromFormat('Y-m-d', $request->input('dtfinal'));
        $value = $dtfin->diffInDays($dtini);

        if($value > 10 || $value < 0)
        {
            echo "<script> alert('O intervalo de datas deve ser menor de 10 dias!') </script> ";
            return $this->acordo();
        }
        $data = Carbon::create();
        var_dump($data);
        $acordos = RegistroOperador::join('tb_csc_acordo','tb_csc_registro_operador.id','=','tb_csc_acordo.id_acordo_fk')
            ->whereBetween('datareg', [$request->input('dtinical'),$request->input('dtfinal')])
            ->get();

        //get all acords
        $macordo = new Acordo();
        //get resources
        $fila = Fila::all();
        $campanha = Campanha::all();
        $negociacao = Negociacao::all();
        $taxa = Taxa::all();
        $codigo = Codigo::all();

        $saida = array(
            'jetValorPreventivoFinanciado' => $macordo->getPreventivoValorFinanciadoSearch($request->input('dtinical') , $request->input('dtfinal')),
            'DataExtenso' => strftime('%B', strtotime('today')),
            'dtinicial' => $request->input('dtinical'),
            'dtfinal' => $request->input('dtfinal'),
            'AllStatus' => $this->getAllStatus(),
            'fila' => $fila,
            'campanha' => $campanha,
            'negociacao' => $negociacao,
            'taxa' => $taxa,
            'codigo' => $codigo
        );

        return view('backoffice.pages.preventivo.preventivoResults', compact('acordos', 'saida'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $id = $request->input('id');
        $status = $request->input('status');
        $negociacao = $request->input('negociacao');
        $fila = $request->input('fila');
        $campanha = $request->input('campanha');
        $codigo = $request->input('codigo');

        $acordos = RegistroOperador::join('tb_csc_acordo','tb_csc_registro_operador.id','=','tb_csc_acordo.id_acordo_fk')
            ->where('id_acordo_fk','=', $id)
            ->first();
        if(!isset($acordos)){ echo 'acordo'; exit();}

        //registra na tabela acordosbko
        $newacordo = new AcordoBackoffice();
        $newacordo->valor = $this->insertInPosition($acordos->valor,-2,'.');
        $newacordo->valor_tfc = $this->insertInPosition($acordos->valor_financiado,-2,'.');
        $newacordo->status = $status;
        $newacordo->usuario_x = $acordos->usuariox;
        $newacordo->dt_vencimento = date('Y-m-d', strtotime($acordos->data_vencimento));
        $newacordo->data = date('Y-m-d', strtotime($acordos->datareg));
        $newacordo->tx_nova = $acordos->taxanova;
        $newacordo->tx_antiga = $acordos->taxaantiga;
        $newacordo->contrato = $acordos->contrato;
        $newacordo->codigo = $codigo;
        $newacordo->tipo_negociacao = $negociacao;
        $newacordo->campanha = $campanha;
        $newacordo->fila = $fila;
        $newacordo->backoffice_name = Auth::user()->getName();
        $newacordo->backoffice_aspect = Auth::user()->getAspect();
        $newacordo->save();
        //atualiza status do acordo
        $acordo = Acordo::find($acordos->id);
        $acordo->status = 1;
        $acordo->save();

        echo 'ok';

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

    //get all status acordo
    private function  getAllStatus()
    {
        return $status = tb_csc_acordo_status::all();
    }

    private function insertInPosition($str, $pos, $c)
    {
        return substr($str, 0, $pos) . $c . substr($str, $pos);
    }

}
