<?php

namespace App\Http\Controllers\BackOffice\Pages\Preventivo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Varejo\Model\CSC\RegistroOperador;
use Illuminate\Support\Carbon;

class Recusa extends Controller
{
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

        $recusa = RegistroOperador::join('tb_csc_recusa','tb_csc_registro_operador.id','=','tb_csc_recusa.id_recusa_csc_fk')
            ->whereBetween('datareg', [date('Y-m-01'),date('Y-m-t') ])
            ->get();

        return view('backoffice.pages.preventivo.recusa', compact('recusa'));
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

        $saida = array(
            'DataExtenso' => strftime('%B', strtotime('today')),
            'dtinicial' => $request->input('dtinical'),
            'dtfinal' => $request->input('dtfinal'),
        );

        $desfavoravel = RegistroOperador::join('tb_csc_recusa','tb_csc_registro_operador.id','=','tb_csc_recusa.id_recusa_csc_fk')
            ->whereBetween('datareg', [$request->input('dtinical'),$request->input('dtfinal')])
            ->get();

        return view('backoffice.pages.preventivo.resultSearchRecusa', compact('desfavoravel', 'saida'));
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
