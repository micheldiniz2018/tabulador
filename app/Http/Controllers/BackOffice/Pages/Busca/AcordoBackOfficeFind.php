<?php

namespace App\Http\Controllers\BackOffice\Pages\Busca;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Varejo\Model\CSC\AcordoBackoffice;
use Illuminate\Support\Carbon;

class AcordoBackOfficeFind extends Controller
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
        $registros = AcordoBackoffice::join('tb_csc_acordo_status','tb_csc_acordo_backoffice.status','=','tb_csc_acordo_status.id')
            ->join('tb_csc_acordo_codigo','tb_csc_acordo_backoffice.codigo','=','tb_csc_acordo_codigo.id')
            ->join('tb_csc_acordo_campanha_tipo_negociacao','tb_csc_acordo_backoffice.tipo_negociacao','=','tb_csc_acordo_campanha_tipo_negociacao.id')
            ->join('tb_csc_acordo_campanha','tb_csc_acordo_backoffice.campanha','=','tb_csc_acordo_campanha.id')
            ->join('tb_filas_cateira','tb_csc_acordo_backoffice.fila','=','tb_filas_cateira.id')
            ->whereBetween('data', [date('Y-08-01'),date('Y-08-t')])
            ->get();

        return view('backoffice.pages.busca.buscaAcordoBackoffice', compact('registros'));
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

        if($value > 31 || $value < 0)
        {
            echo "<script> alert('O intervalo de datas deve ser menor de 31 dias!') </script> ";
            return $this->index();
        }

        $saida = array('DataExtenso' => strftime('%B', strtotime('today')),
            'dtinicial' => $request->input('dtinical'),
            'dtfinal' => $request->input('dtfinal'),
        );

        $data = Carbon::create();
        //dd($data);
        $registros = AcordoBackoffice::join('tb_csc_acordo_status','tb_csc_acordo_backoffice.status','=','tb_csc_acordo_status.id')
            ->join('tb_csc_acordo_codigo','tb_csc_acordo_backoffice.codigo','=','tb_csc_acordo_codigo.id')
            ->join('tb_csc_acordo_campanha_tipo_negociacao','tb_csc_acordo_backoffice.tipo_negociacao','=','tb_csc_acordo_campanha_tipo_negociacao.id')
            ->join('tb_csc_acordo_campanha','tb_csc_acordo_backoffice.campanha','=','tb_csc_acordo_campanha.id')
            ->join('tb_filas_cateira','tb_csc_acordo_backoffice.fila','=','tb_filas_cateira.id')
            ->whereBetween('data', [date('Y-m-d', strtotime($dtini)),date('Y-m-d', strtotime($dtfin))])
            ->get();



        return view('backoffice.pages.busca.resultBuscaAcordoBackOffice', compact('registros','saida'));

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
